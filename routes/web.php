<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SalesReportController;
use App\Models\Product; 
use App\Models\PurchaseOrder; 
use App\Models\Sale; // <-- Added to fetch sales data!
use Carbon\Carbon;   // <-- Added to handle dates for the 7-day chart!
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// --- DASHBOARD WITH LIVE CHARTS ---
Route::get('/dashboard', function () {
    
    // 1. Main metrics
    $totalProducts = Product::count();
    $lowStockCount = Product::whereColumn('stock', '<=', 'alert_level')->count();
    $inventoryValue = Product::selectRaw('SUM(stock * price) as total')->value('total') ?? 0;
    $pendingPurchases = class_exists(PurchaseOrder::class) ? PurchaseOrder::where('status', 'Pending')->count() : 0;
    
    $lowStockItems = Product::whereColumn('stock', '<=', 'alert_level')
                            ->orderBy('stock', 'asc')
                            ->take(5)
                            ->get();

    // 2. LIVE CHART DATA: Weekly Sales Performance (Last 7 Days)
    $last7Days = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i)->format('Y-m-d');
        $dayName = Carbon::now()->subDays($i)->format('D'); // Mon, Tue, etc.
        $last7Days->put($date, ['day' => $dayName, 'total' => 0]); 
    }

    // Only run this if the Sale table exists
    if (class_exists(Sale::class) && \Illuminate\Support\Facades\Schema::hasTable('sales')) {
        $sales = Sale::where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
                     ->selectRaw('DATE(created_at) as date, SUM(total) as daily_total')
                     ->groupBy('date')
                     ->get();

        foreach ($sales as $sale) {
            if (isset($last7Days[$sale->date])) {
                $data = $last7Days[$sale->date];
                $data['total'] = $sale->daily_total;
                $last7Days[$sale->date] = $data;
            }
        }
        
        // 3. LIVE CHART DATA: Sales by Category
        $categorySales = Sale::selectRaw('category, SUM(total) as category_total')
                             ->groupBy('category')
                             ->get();
    } else {
        $categorySales = collect();
    }

    return view('dashboard', compact(
        'totalProducts', 
        'lowStockCount', 
        'inventoryValue',
        'pendingPurchases', 
        'lowStockItems',
        'last7Days',
        'categorySales'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// --- PROTECTED ROUTES ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Inventory Routes
    Route::get('/inventory', [ProductController::class, 'index'])->name('inventory');
    Route::post('/inventory', [ProductController::class, 'store'])->name('inventory.store');
    Route::put('/inventory/{id}', [ProductController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{id}', [ProductController::class, 'destroy'])->name('inventory.destroy');

    // Customer Routes
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Purchasing & Orders Routes
    Route::get('/purchases', [PurchaseOrderController::class, 'index'])->name('purchases.index');
    Route::post('/purchases', [PurchaseOrderController::class, 'store'])->name('purchases.store');
    Route::match(['post', 'patch'], '/purchases/{id}/receive', [PurchaseOrderController::class, 'markReceived'])->name('purchases.receive');
    // Sales Report Dashboard Route
    Route::get('/sales-report', [SalesReportController::class, 'index'])->name('sales.report');
    Route::put('/purchases/{id}/receive', [App\Http\Controllers\PurchaseOrderController::class, 'receive'])->name('purchases.receive');
    Route::delete('/purchases/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchases.destroy');

    // Rental Assets Routes
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::put('/rentals/{id}', [RentalController::class, 'update'])->name('rentals.update');
    Route::delete('/rentals/{id}', [RentalController::class, 'destroy'])->name('rentals.destroy');
    Route::post('/rentals/{rental}/book', [RentalController::class, 'book'])->name('rentals.book');
    Route::post('/rentals/{rental}/return', [RentalController::class, 'returnAsset'])->name('rentals.return');
    Route::post('/rentals/{rental}/maintenance', [RentalController::class, 'toggleMaintenance'])->name('rentals.maintenance');

    // POS Routes
    Route::get('/pos', function () { 
        $products = Product::orderBy('name', 'asc')->get();
        return view('pos', compact('products')); 
    })->name('pos');
    Route::post('/pos/checkout', [ProductController::class, 'checkout'])->name('pos.checkout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';