<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // 1. READ (Send database customers to your HTML page)
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Customer::query();

        // 1. Search Bar Filter (Searches name, email, or phone)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // 2. Type Dropdown Filter (Retail / Wholesale)
        if ($request->filled('type') && $request->type !== 'All') {
            $query->where('type', $request->type);
        }

        // 3. Status Tabs Filter (Active / Inactive)
        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        // Get customers, paginate to exactly 5 items per page, and remember filters!
        $customers = $query->orderBy('created_at', 'desc')
                           ->paginate(5)
                           ->withQueryString(); 

        // Get actual counts for the Badges so they don't only count 5 items
        $allCount = Customer::count();
        $activeCount = Customer::where('status', 'Active')->count();
        $inactiveCount = Customer::where('status', 'Inactive')->count();

        return view('customers', compact('customers', 'allCount', 'activeCount', 'inactiveCount'));
    }

    // 2. CREATE (Save a new customer)
    public function store(Request $request)
    {
        Customer::create($request->all());
        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    // 3. UPDATE (Edit an existing customer)
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    // 4. DELETE (Remove a customer)
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }
}