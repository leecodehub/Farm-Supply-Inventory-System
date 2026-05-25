<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Product; // <-- Added Product Model!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Added DB for transaction safety

class PurchaseOrderController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // 1. CALCULATE STATISTICS FOR THE TOP CARDS
        $approvedOrders = PurchaseOrder::where('status', 'Received')->count();
        $pendingDeliveries = PurchaseOrder::where('status', 'Pending')->count();
        $totalSpent = PurchaseOrder::where('status', '!=', 'Cancelled')->sum('total_amount');

        // 2. SERVER-SIDE FILTERING & PAGINATION
        $query = PurchaseOrder::with('items');

        // Filter by Status (Tabs)
        if ($request->has('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        // --------------------------------------------------------
        // Filter by Supplier (Dropdown) - THIS WAS MISSING!
        // --------------------------------------------------------
        if ($request->has('supplier') && $request->supplier !== 'All') {
            $query->where('supplier', $request->supplier);
        }

        // Filter by Search (PO Number or Supplier text search)
        if ($request->has('search') && $request->search !== '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('po_number', 'like', '%' . $searchTerm . '%')
                  ->orWhere('supplier', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply pagination (5 items per page)
        $purchaseOrders = $query->orderBy('created_at', 'desc')
                                ->paginate(5)
                                ->withQueryString();

        // 3. COUNTS FOR THE TABS
        $allCount = PurchaseOrder::count();
        $pendingCount = PurchaseOrder::where('status', 'Pending')->count();
        $receivedCount = PurchaseOrder::where('status', 'Received')->count();
        $cancelledCount = PurchaseOrder::where('status', 'Cancelled')->count();

        // 4. Fetch products for the dropdowns
        $products = Product::orderBy('name', 'asc')->get();
        
        // 5. Pass everything to the view
        return view('purchasing', compact(
            'approvedOrders', 
            'pendingDeliveries', 
            'totalSpent', 
            'purchaseOrders', 
            'products',
            'allCount',
            'pendingCount',
            'receivedCount',
            'cancelledCount'
        ));
    }

    public function store(Request $request)
    {
        // 1. Basic validation
        $request->validate([
            'supplier' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // 2. Generate a Unique PO Number
        $poNumber = 'PO-' . date('Y') . '-' . strtoupper(substr(uniqid(), -4));

        // 3. Create the Main Order
        $po = PurchaseOrder::create([
            'po_number' => $poNumber,
            'supplier' => $request->supplier,
            'total_amount' => $request->total_amount,
            'expected_delivery' => $request->expected_delivery,
            'status' => 'Pending',
        ]);

        // 4. Use the exact names from your blade file (with an 's')
        $itemNames = $request->input('item_names', []);
        $itemCategories = $request->input('item_categories', []); 
        $unitPrices = $request->input('unit_prices', []);
        $quantities = $request->input('quantities', []);

        $itemsToInsert = [];

        // 5. Loop through them and prepare them for database injection
        foreach ($itemNames as $index => $name) {
            
            // Skip empty rows or old dropdown placeholders
            if (trim($name) === '' || str_contains($name, 'Select Item')) {
                continue; 
            }

            $qty = isset($quantities[$index]) ? (float)$quantities[$index] : 1;
            $price = isset($unitPrices[$index]) ? (float)$unitPrices[$index] : 0;
            $category = isset($itemCategories[$index]) ? $itemCategories[$index] : 'Farm Supply';

            $itemsToInsert[] = [
                'purchase_order_id' => $po->id,
                'item_name'         => trim($name),
                'item_category'     => $category,
                'quantity'          => $qty,
                'unit_price'        => $price,
                'total_price'       => $qty * $price,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        // 6. BULK INSERT directly to the database
        if (!empty($itemsToInsert)) {
            PurchaseOrderItem::insert($itemsToInsert);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase Order created successfully!');
    }

    public function markReceived($id)
    {
        $po = PurchaseOrder::with('items')->findOrFail($id);

        // Prevent receiving an order twice
        if ($po->status === 'Received') {
            return redirect()->route('purchases.index')->with('error', 'Order has already been received.');
        }

        // DB::transaction ensures that if anything fails, it rolls back the whole process
        DB::transaction(function () use ($po) {
            
            // 1. Mark the PO as Received
            $po->update(['status' => 'Received']);

            // 2. AUTOMATIC INVENTORY SYNC: Loop through items and update stock!
            foreach ($po->items as $item) {
                // Find the actual product in the inventory by its name
                $product = Product::where('name', $item->item_name)->first();

                if ($product) {
                    // FIXED: Changed 'stock_qty' to 'stock' to match your database column perfectly!
                    $product->increment('stock', $item->quantity);
                }
            }
            
        });

        return redirect()->route('purchases.index')->with('success', "Order {$po->po_number} received! Inventory stock has been updated.");
    }

    public function destroy($id)
    {
        $po = PurchaseOrder::findOrFail($id);
        
        // If the order is ALREADY cancelled, permanently delete it from the database
        if ($po->status === 'Cancelled' || $po->status === 'Delayed') {
            $po->delete();
            return redirect()->route('purchases.index')->with('success', 'Purchase Order record permanently deleted.');
        }

        // Otherwise, just change its status to Cancelled so it goes to the Cancelled tab
        $po->update(['status' => 'Cancelled']);
        return redirect()->route('purchases.index')->with('success', 'Purchase Order marked as Cancelled.');
    }
}