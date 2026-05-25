<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Customer;
use App\Models\RentalTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // <-- Used to easily and strictly calculate dates!

class RentalController extends Controller
{
    // 1. Display the Rentals page
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Rental::with(['transactions' => function($q) {
            $q->where('status', 'Active')->with('customer');
        }]);

        // 1. Search Bar Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sn', 'like', "%{$search}%");
            });
        }

        // 2. Category Dropdown Filter
        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        // 3. Status Tabs Filter (NEW!)
        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'available') {
                $query->where('status', 'Available');
            } elseif ($request->status === 'rented') {
                $query->where('status', 'Rented');
            } elseif ($request->status === 'maintenance') {
                $query->where('status', 'Maintenance');
            }
        }

        // Get rentals, paginate to exactly 4 items per page, and remember filters!
        $rentals = $query->orderBy('created_at', 'desc')
                         ->paginate(4)
                         ->withQueryString(); 
        
        // Get all customers for the Booking dropdown
        $customers = Customer::all();
        
        return view('rentals', compact('rentals', 'customers'));
    }

    // 2. Add a new Rental Asset
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sn' => 'required|string|unique:rentals,sn',
            'category' => 'required|string',
            'daily_rate' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['status'] = 'Available';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rentals', 'public');
            $data['image'] = $imagePath;
        }

        Rental::create($data);

        return redirect()->route('rentals.index')->with('success', 'Rental asset added successfully!');
    }

    // 3. Update an existing Rental Asset
    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'sn' => 'required|string|unique:rentals,sn,' . $rental->id,
            'category' => 'required|string',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('image')) {
            if ($rental->image) {
                Storage::disk('public')->delete($rental->image);
            }
            $data['image'] = $request->file('image')->store('rentals', 'public');
        }

        $rental->update($data);

        return redirect()->route('rentals.index')->with('success', 'Rental asset updated successfully!');
    }

    // 4. Delete an Asset
    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->image) {
            Storage::disk('public')->delete($rental->image);
        }

        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Asset removed from inventory.');
    }

    // 5. Book an Asset (Assign to Customer)
    public function book(Request $request, Rental $rental)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'expected_return_date' => 'required|date|after_or_equal:today'
        ]);

        // Create the official logbook entry
        RentalTransaction::create([
            'rental_id' => $rental->id,
            'customer_id' => $request->customer_id,
            'start_date' => now(),
            'expected_return_date' => $request->expected_return_date,
            'status' => 'Active',
        ]);

        // Change the asset's status to Rented
        $rental->update(['status' => 'Rented']);

        return back()->with('success', $rental->name . ' has been booked successfully!');
    }

    // 6. Return an Asset & Calculate Final Price
    public function returnAsset(Request $request, Rental $rental)
    {
        // 1. Validate the new inputs
        $request->validate([
            'damage_fee' => 'nullable|numeric|min:0',
            'return_notes' => 'nullable|string|max:1000'
        ]);

        // 2. Find the active logbook entry
        $transaction = RentalTransaction::where('rental_id', $rental->id)
                                        ->where('status', 'Active')
                                        ->latest()
                                        ->first();
        $totalPaid = 0;

        if ($transaction) {
            // 3. Strict Date Math: Use startOfDay() so hours don't mess up the calculation
            $start = Carbon::parse($transaction->start_date)->startOfDay();
            $end = now()->startOfDay();
            $days = $start->diffInDays($end);
            
            // If they return it on the exact same day, we still charge them for 1 day minimum
            if ($days < 1) {
                $days = 1;
            }

            // 4. Strict Number Math: Strip commas out of strings to prevent PHP math errors!
            $dailyRate = floatval(str_replace(',', '', $rental->daily_rate));
            $damageFee = floatval(str_replace(',', '', $request->input('damage_fee') ?? 0));
            
            $baseCost = $days * $dailyRate;
            $totalPaid = $baseCost + $damageFee;

            // 5. Update the transaction record
            $transaction->update([
                'actual_return_date' => now(),
                'status' => 'Returned',
                'damage_fee' => $damageFee,
                'total_amount_paid' => $totalPaid,
                'return_notes' => $request->input('return_notes')
            ]);
        }

        // 6. Make the asset available again
        $rental->update(['status' => 'Available']);

        // Format exactly to 2 decimal places for the green success message
        return back()->with('success', $rental->name . ' safely returned! Final Charge: ₱' . number_format($totalPaid, 2));
    }

    // 7. Toggle Maintenance Status
    public function toggleMaintenance(Rental $rental)
    {
        if ($rental->status === 'Available') {
            $rental->update(['status' => 'Maintenance']);
            return back()->with('success', $rental->name . ' has been put under maintenance.');
        } elseif ($rental->status === 'Maintenance') {
            $rental->update(['status' => 'Available']);
            return back()->with('success', $rental->name . ' is now marked as available and ready for rent.');
        }

        return back()->with('error', 'Cannot change maintenance status while the asset is rented.');
    }
}