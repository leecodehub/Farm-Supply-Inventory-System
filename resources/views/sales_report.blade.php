<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Ledger Report - Farmtastic</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
</head>

<body
    class="bg-[#F4F7F6] h-screen flex font-sans text-gray-800 overflow-hidden relative selection:bg-[#5A8265] selection:text-white">

    <aside
        class="hidden md:flex w-[80px] hover:w-[260px] bg-[#2C4A3E] text-white flex-col h-full flex-shrink-0 z-20 transition-all duration-300 group overflow-hidden absolute md:relative shadow-xl print:hidden">

        <div class="p-6 border-b border-white/10 flex items-center gap-3 whitespace-nowrap">
            <img src="{{ asset('images/logo.png') }}" alt="Farmtastic Logo"
                class="w-10 h-10 object-contain flex-shrink-0 drop-shadow-sm">
            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <h1 class="font-bold text-lg leading-tight tracking-wide">Farmtastic</h1>
                <p class="text-[11px] text-[#A6BBAA] font-medium tracking-wide">Farm Supply</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 overflow-x-hidden custom-scrollbar">

            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('dashboard*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('dashboard*') ? 'opacity-90' : 'opacity-70' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Dashboard</span>
                </a>
            @endif

            <a href="/inventory"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('inventory*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('inventory*') ? 'opacity-90' : 'opacity-70' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Stock Overview</span>
            </a>

            <a href="/pos"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('pos*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('pos*') ? 'opacity-90' : 'opacity-70' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sales (POS)</span>
            </a>

            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="/purchases"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('purchasing*', 'purchases*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('purchasing*', 'purchases*') ? 'opacity-90' : 'opacity-70' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Purchasing &
                        Orders</span>
                </a>
            @endif

            <a href="/customers"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('customers*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('customers*') ? 'opacity-90' : 'opacity-70' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Customers</span>
            </a>

            <a href="/rentals"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('rentals*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('rentals*') ? 'opacity-90' : 'opacity-70' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Rental Assets</span>
            </a>
            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('sales.report') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('sales-report*') || Route::currentRouteName() == 'sales.report' ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('sales-report*') || Route::currentRouteName() == 'sales.report' ? 'opacity-90' : 'opacity-70' }}" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586A1 1 0 0113 3.414l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sales Reports</span>
                </a>
            @endif
        </nav>

        <div class="p-4 border-t border-white/10 overflow-hidden">
        <div onclick="openLogoutModal()" class="flex items-center justify-center group-hover:justify-start gap-3 p-2 hover:bg-white/10 rounded-xl cursor-pointer transition-all w-full overflow-hidden">
            <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 uppercase">
                {{ substr(Auth::user()?->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-col flex-1 min-w-0 hidden group-hover:flex text-left">
                <span class="text-sm font-bold text-white truncate block">{{ Auth::user()?->name ?? 'User' }}</span>
                <span class="text-[11px] text-[#A6BBAA] truncate block">{{ Auth::user()?->email ?? 'staff@farmtastic.com' }}</span>
            </div>
        </div>
    </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden relative z-10">
        
        <header class="bg-white border-b border-gray-200/80 px-8 py-4 flex items-center justify-between flex-shrink-0">
            <div>
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Farm Sales Revenue Logs</h2>
                <p class="text-xs text-gray-500 mt-0.5">Review overall point-of-sale operational checkout histories, metrics, and receipts</p>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 print:hidden">

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div class="p-2.5 bg-emerald-50 rounded-lg text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Gross Sales Revenue</span>
                    </div>
                    <div class="text-right mt-auto">
                        <h3 class="text-2xl font-bold text-gray-900">₱{{ number_format($totalRevenue ?? 0, 2) }}</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div class="p-2.5 bg-blue-50 rounded-lg text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Units Handed Out</span>
                    </div>
                    <div class="text-right mt-auto">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalItemsSold ?? 0) }} Items</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div class="p-2.5 bg-amber-50 rounded-lg text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Top Performing Segment</span>
                    </div>
                    <div class="text-right mt-auto">
                        <h3 class="text-xl font-bold text-gray-900 truncate max-w-full">{{ $topCategory ?? 'None' }}</h3>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
                
                <div class="p-5 border-b border-gray-200/80 bg-gray-50/50 flex flex-wrap items-center justify-between gap-4">
                    <form method="GET" action="{{ route('sales.report') }}" id="reportFilterForm" class="flex flex-wrap items-center gap-3 w-full md:w-auto m-0">
                        
                        <div class="relative w-full md:w-64">
                            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products or segment..." class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] focus:border-[#5A8265]">
                        </div>

                        <select name="date_range" onchange="document.getElementById('reportFilterForm').submit()" class="py-2 pl-3 pr-8 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] text-gray-600 appearance-none">
                            <option value="today" {{ $datePreset == 'today' ? 'selected' : '' }}>Today's Checkout Logs</option>
                            <option value="this_week" {{ $datePreset == 'this_week' ? 'selected' : '' }}>This Week</option>
                            <option value="last_7_days" {{ $datePreset == 'last_7_days' ? 'selected' : '' }}>Last 7 Inbound Days</option>
                            <option value="this_month" {{ $datePreset == 'this_month' ? 'selected' : '' }}>This Month (Standard)</option>
                            <option value="this_year" {{ $datePreset == 'this_year' ? 'selected' : '' }}>Full Year Metrics</option>
                        </select>

                        @if(request('search') || request('category') || request('date_range') != 'this_month')
                            <a href="{{ route('sales.report') }}" class="text-xs text-red-500 font-bold hover:underline whitespace-nowrap ml-1">Clear Filters</a>
                        @endif
                    </form>
                    
                    <span class="text-xs text-gray-400 font-medium font-mono bg-white px-2 py-1 rounded border border-gray-100 shadow-sm">
                        Total Batches: {{ $groupedReceipts->total() }} Transactions Found
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse m-0">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                <th class="p-4 pl-6">Invoice Number</th>
                                <th class="p-4">Checkout Completed Date</th>
                                <th class="p-4">Customer Segment</th>
                                <th class="p-4 text-center">Items Dispatched</th>
                                <th class="p-4 text-right">Receipt Value Sum</th>
                                <th class="p-4 pr-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-y-gray-100 text-sm text-gray-600">
                            @forelse($groupedReceipts as $receipt)
                                <tr class="hover:bg-gray-50/70 transition-colors">
                                    <td class="p-4 pl-6 font-mono font-bold text-xs text-[#2C4A3E]">
                                        {{ $receipt['invoice_number'] }}
                                    </td>
                                    <td class="p-4 text-gray-700">
                                        {{ $receipt['formatted_date'] }}
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            {{ $receipt['customer_name'] }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center font-bold text-gray-800">
                                        {{ $receipt['items_count'] }}
                                    </td>
                                    <td class="p-4 text-right font-black text-gray-900 font-mono">
                                        ₱{{ number_format($receipt['total_amount'], 2) }}
                                    </td>
                                    <td class="p-4 pr-6 text-center">
                                        <button type="button" onclick="launchReceiptViewerDrawer({{ json_encode($receipt) }})" class="px-3 py-1.5 bg-gray-100 hover:bg-[#5A8265] hover:text-white text-gray-600 text-xs font-bold rounded-lg transition-all shadow-sm border border-gray-200/50">
                                            Inspect Receipt
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-12 text-center text-gray-400 font-medium">
                                        <svg class="w-10 h-10 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586A1 1 0 0113 3.414l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        No financial operational sales logs recorded matching this active date window.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- MATCHING PAGINATION DESIGN FOOTER --}}
                <div class="border-t border-gray-200 px-6 py-4 bg-gray-50/50 print:hidden">
                    {{ $groupedReceipts->links() }}
                </div>
            </div>
        </div>
    </main>

    <div id="drawerReceiptBackdrop" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300 backdrop-blur-xs no-print"></div>
    
    <aside id="drawerReceiptPanel" class="fixed right-0 top-0 bottom-0 w-full max-w-md bg-white border-l border-gray-200 shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col no-print">
        
        <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gray-50">
            <div>
                <h3 class="font-black text-gray-800 text-base">Receipt Audit Detail</h3>
                <p class="text-xs text-gray-400 font-mono mt-0.5" id="drawer-invoice-title">INV-00000</p>
            </div>
            <button onclick="dismissReceiptViewerDrawer()" class="w-8 h-8 rounded-full bg-white hover:bg-gray-100 border border-gray-200 text-gray-400 hover:text-gray-600 flex items-center justify-center transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-6 custom-scrollbar space-y-6 bg-gray-50/50">
            
            <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-5 font-mono text-xs text-gray-800 space-y-4 relative overflow-hidden" id="printable-receipt-content">
                
                <div class="text-center space-y-1 pb-4 border-b border-dashed border-gray-200">
                    <h4 class="text-base font-black tracking-wider text-gray-900 uppercase">FARMTAS<span class="text-[#5A8265]">TIC</span> STORES</h4>
                    <p class="text-[10px] text-gray-400">Davao City, Philippines</p>
                    <p class="text-[10px] text-gray-400">VAT REG TIN: 000-123-456-000</p>
                </div>

                <div class="space-y-1 py-1 text-[11px] text-gray-600">
                    <div class="flex justify-between"><span>INVOICE ID:</span><span class="font-bold text-gray-900" id="rec-meta-id">N/A</span></div>
                    <div class="flex justify-between"><span>DATE TIME:</span><span id="rec-meta-date">N/A</span></div>
                    <div class="flex justify-between"><span>CUSTOMER:</span><span id="rec-meta-cust" class="font-bold">Walk-In Retail</span></div>
                    <div class="flex justify-between"><span>MODE:</span><span>Cash Checkout (POS)</span></div>
                </div>

                <div class="border-t border-b border-dashed border-gray-200 py-3">
                    <table class="w-full text-left border-none">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase">
                                <th class="pb-2">Product Description</th>
                                <th class="pb-2 text-center">QTY</th>
                                <th class="pb-2 text-right">Price</th>
                                <th class="pb-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody id="receipt-items-tbody" class="text-[11px] text-gray-700 divide-y divide-dashed divide-gray-100">
                            </tbody>
                    </table>
                </div>

                <div class="space-y-1.5 pt-1 text-right text-[11px]">
                    <div class="flex justify-between text-gray-500">
                        <span>Items Subtotal:</span>
                        <span id="rec-sum-subtotal">₱0.00</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span>Tax / VAT Amount (12%):</span>
                        <span>Included</span>
                    </div>
                    <div class="flex justify-between text-base font-black text-gray-900 border-t border-dashed border-gray-200 pt-3">
                        <span>GRAND TOTAL:</span>
                        <span id="rec-sum-grand">₱0.00</span>
                    </div>
                </div>

                <div class="text-center pt-4 border-t border-dashed border-gray-200 text-[10px] text-gray-400 space-y-0.5">
                    <p class="font-bold uppercase text-gray-500">Thank you for your business!</p>
                    <p>Returns accepted within 7 days with validation tags intact.</p>
                    <p class="font-mono mt-2 tracking-widest text-gray-300">*** END OF RECEIPT ***</p>
                </div>
            </div>
        </div>

        <div class="p-4 border-t border-gray-100 bg-white flex items-center gap-3">
            <button type="button" onclick="window.print()" class="flex-1 py-2.5 bg-[#2C4A3E] hover:bg-[#1E332B] text-white rounded-xl text-sm font-bold shadow-sm transition-all text-center">
                Print Paper Receipt
            </button>
        </div>
    </aside>

    <div id="logoutModal" class="relative z-[200] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border-t-4 border-[#5A8265]">
                    
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#E8F0EA] sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-[#5A8265]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Ready to leave?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to log out of your account?</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-[#5A8265] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#4A6B53] sm:ml-3 sm:w-auto transition-colors">
                                Yes, Log Out
                            </button>
                        </form>
                        <button type="button" onclick="closeLogoutModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                            Cancel
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        const backdrop = document.getElementById('drawerReceiptBackdrop');
        const panel = document.getElementById('drawerReceiptPanel');

        function launchReceiptViewerDrawer(receiptData) {
            // Update Text Node Labels 
            document.getElementById('drawer-invoice-title').textContent = receiptData.invoice_number;
            document.getElementById('rec-meta-id').textContent = receiptData.invoice_number;
            document.getElementById('rec-meta-date').textContent = receiptData.formatted_date;
            document.getElementById('rec-meta-cust').textContent = receiptData.customer_name;
            
            // Recompute Financial Totals Strings
            document.getElementById('rec-sum-subtotal').textContent = '₱' + parseFloat(receiptData.total_amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('rec-sum-grand').textContent = '₱' + parseFloat(receiptData.total_amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            // Clear Out and Rebuild the HTML Rows for items
            const tbody = document.getElementById('receipt-items-tbody');
            tbody.innerHTML = '';

            receiptData.lines.forEach(line => {
                const tr = document.createElement('tr');
                tr.className = 'border-b border-gray-100/40 py-2';
                tr.innerHTML = `
                    <td class="py-2.5 font-sans">
                        <div class="font-bold text-gray-900">${line.name}</div>
                        <div class="text-[9px] text-gray-400 font-mono tracking-tight">${line.sku} | ${line.category}</div>
                    </td>
                    <td class="py-2.5 text-center text-gray-800 font-bold font-mono">${line.qty}</td>
                    <td class="py-2.5 text-right font-mono text-gray-500">₱${parseFloat(line.price).toFixed(2)}</td>
                    <td class="py-2.5 text-right font-bold font-mono text-gray-900">₱${parseFloat(line.line_total).toFixed(2)}</td>
                `;
                tbody.appendChild(tr);
            });

            // Fire CSS Slide Over Animations
            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                panel.classList.remove('translate-x-full');
            }, 10);
        }

        function dismissReceiptViewerDrawer() {
            panel.classList.add('translate-x-full');
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300);
        }

        // Close when clicking outside on the dark translucent backdrop layout
        backdrop.addEventListener('click', dismissReceiptViewerDrawer);

        function openLogoutModal() { document.getElementById('logoutModal').classList.remove('hidden'); }
        function closeLogoutModal() { document.getElementById('logoutModal').classList.add('hidden'); }
    </script>
</body>

</html>