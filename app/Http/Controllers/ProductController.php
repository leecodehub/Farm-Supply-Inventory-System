<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale; // <-- ADDED: Allows us to save sales history for the Dashboard charts!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 

class ProductController extends Controller
{
    // 1. READ (Send database products to your HTML page)
    // 1. READ (Send database products to your HTML page)
    public function index(Request $request)
    {
        $query = Product::query();

        // Search Bar Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category Dropdown Filter
        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        // Stock Level Tabs Filter
        if ($request->filled('stock_filter')) {
            if ($request->stock_filter === 'low') {
                $query->where('stock', '<=', 10)->where('stock', '>', 0);
            } elseif ($request->stock_filter === 'out') {
                $query->where('stock', 0);
            }
        }

        // THIS IS THE MAGIC LINE: paginate(5) forces exactly 5 items per page!
        $products = $query->orderBy('created_at', 'desc')
                          ->paginate(5)
                          ->withQueryString();

        // Get the actual counts for the Badges
        $lowStockCount = Product::where('stock', '<=', 10)->where('stock', '>', 0)->count();
        $outOfStockCount = Product::where('stock', 0)->count();

        return view('inventory', compact('products', 'lowStockCount', 'outOfStockCount'));
    }

    // 2. CREATE (Updated with image upload logic)
    public function store(Request $request)
    {
        // Start with all form data
        $data = $request->all();

        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            // Validate the file is an image and not too big (e.g., max 2MB)
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            // Save the file to storage/app/public/products and get the path
            $path = $request->file('image')->store('products', 'public');
            
            // Add the new filename to our data array
            $data['image'] = basename($path);
        }

        // Create the product in the database with all data
        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // 3. UPDATE (Updated with image replacement logic)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Start with all form data
        $data = $request->all();

        // Check if a *new* image was uploaded
        if ($request->hasFile('image')) {
            // Validate the new file
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            // Delete the old image if one exists
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            // Save the new file and get the path
            $path = $request->file('image')->store('products', 'public');
            
            // Update the filename in our data array
            $data['image'] = basename($path);
        }

        // Update the product in the database
        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    // 4. DELETE (Updated to also delete the image file)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the image file if one exists
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }

        // Delete the database entry
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    // 5. CHECKOUT (Fixed the Error & Added Chart Tracking!)
    public function checkout(Request $request)
    {
        $cart = $request->input('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty.']);
        }

        // DB::transaction ensures that if one item fails, the whole sale is canceled safely
        DB::transaction(function () use ($cart) {
            foreach ($cart as $item) {
                // FIX: Safely check for 'id' OR 'product_id' so it never crashes again!
                $productId = $item['id'] ?? $item['product_id'] ?? null;
                
                if (!$productId) {
                    continue;
                }

                // Find the product in the database
                $product = Product::find($productId);
                
                // If the product exists and has enough stock...
                if ($product && $product->stock >= $item['qty']) {
                    // 1. Deduct the stock
                    $product->decrement('stock', $item['qty']);

                    // 2. Save the sale to the database for the Dashboard charts!
                    Sale::create([
                        'product_id' => $product->id,
                        'category'   => $product->category,
                        'qty'        => $item['qty'],
                        'price'      => $product->price,
                        'total'      => $product->price * $item['qty'],
                    ]);
                }
            }
        });

        return response()->json(['success' => true, 'message' => 'Sale completed successfully!']);
    }
}