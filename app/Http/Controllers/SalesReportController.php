<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. CHOOSE FILTER DATE RANGE PRESETS
        $datePreset = $request->input('date_range', 'this_month');
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        if ($datePreset === 'today') {
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
        } elseif ($datePreset === 'this_week') {
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
        } elseif ($datePreset === 'last_7_days') {
            $startDate = now()->subDays(6)->startOfDay();
            $endDate = now()->endOfDay();
        } elseif ($datePreset === 'this_year') {
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
        }

        // 2. QUERY INDIVIDUAL LINE SALE ITEMS WITH FILTERS
        $query = Sale::with('product')
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Category Filtering
        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        // Text Search (Product Name, SKU, or Category keyword matches)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('category', 'like', "%{$search}%")
                  ->orWhereHas('product', function($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                  });
            });
        }

        // Get matching sales records across all history for top cards metrics
        $allFilteredSales = $query->orderBy('created_at', 'desc')->get();

        // 3. AGGREGATE CORE SUMMARY WIDGET METRICS
        $totalRevenue = $allFilteredSales->sum('total');
        $totalItemsSold = $allFilteredSales->sum('qty');
        
        // Find top selling product category
        $topCategory = $allFilteredSales->groupBy('category')
            ->map(fn($group) => $group->sum('qty'))
            ->sortDesc()
            ->keys()
            ->first() ?? 'None';

        // 4. GROUP TIMESTAMPS FOR STRUCTURED RECEIPT PAGINATION
        // Get unique purchase timestamps following matching criteria
        $timestampQuery = Sale::whereBetween('created_at', [$startDate, $endDate]);
        
        if ($request->filled('category') && $request->category !== 'All') {
            $timestampQuery->where('category', $request->category);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $timestampQuery->where(function($q) use ($search) {
                $q->where('category', 'like', "%{$search}%")
                  ->orWhereHas('product', function($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                  });
            });
        }

        // Grab unique structural timestamps matching search profiles
        $uniqueTimestamps = $timestampQuery->select('created_at')
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        // 5. SERVER-SIDE SLICE & MAP ONLY CURRENT PAGE ITEMS (5 Receipts Per Page)
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentItemsSlice = $uniqueTimestamps->slice(($currentPage - 1) * $perPage, $perPage);

        $mappedReceiptsCollection = collect($currentItemsSlice)->map(function($saleItem) {
            $timestamp = $saleItem->created_at->format('Y-m-d H:i:s');
            
            // Gather all specific items checked out under this window
            $items = Sale::with('product')->where('created_at', $timestamp)->get();
            $invoiceId = 'INV-' . Carbon::parse($timestamp)->format('Ymd-His');
            
            return [
                'invoice_number' => $invoiceId,
                'timestamp'      => $timestamp,
                'formatted_date' => Carbon::parse($timestamp)->format('M d, Y h:i A'),
                'items_count'    => $items->sum('qty'),
                'total_amount'   => $items->sum('total'),
                'customer_name'  => 'Walk-In Customer',
                'lines'          => $items->map(function($line) {
                    return [
                        'name'       => $line->product->name ?? 'Deleted Product',
                        'sku'        => $line->product->sku ?? 'N/A',
                        'category'   => $line->category,
                        'qty'        => $line->qty,
                        'price'      => $line->price,
                        'line_total' => $line->total
                    ];
                })
            ];
        });

        // 6. BUILD THE UNIFIED PAGINATOR OBJECT
        $groupedReceipts = new LengthAwarePaginator(
            $mappedReceiptsCollection, 
            $uniqueTimestamps->count(), 
            $perPage, 
            $currentPage, 
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query(),
            ]
        );

        // Pass clean elements down to the matching view
        return view('sales_report', compact(
            'groupedReceipts',
            'totalRevenue',
            'totalItemsSold',
            'topCategory',
            'datePreset'
        ));
    }
}