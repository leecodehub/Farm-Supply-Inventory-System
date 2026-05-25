<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchases & Orders - Farmtastic</title>
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

        .hide-arrows::-webkit-outer-spin-button,
        .hide-arrows::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .hide-arrows {
            -moz-appearance: textfield;
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
            <div onclick="openLogoutModal()"
                class="flex items-center justify-center group-hover:justify-start gap-3 p-2 hover:bg-white/10 rounded-xl cursor-pointer transition-all w-full overflow-hidden">
                <div
                    class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 uppercase">
                    {{ substr(Auth::user()?->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-col flex-1 min-w-0 hidden group-hover:flex text-left">
                    <span
                        class="text-sm font-bold text-white truncate block">{{ Auth::user()?->name ?? 'User' }}</span>
                    <span
                        class="text-[11px] text-[#A6BBAA] truncate block">{{ Auth::user()?->email ?? 'staff@farmtastic.com' }}</span>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 bg-[#F4F7F6] pl-[80px] md:pl-0 transition-all duration-300 overflow-hidden">

        <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between flex-shrink-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Purchases & Orders</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your supplier orders and track deliveries.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="exportTableToCSV('purchases_export.csv')"
                    class="px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Data
                </button>
                <button onclick="openModal('modal-create-po')"
                    class="px-4 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-all shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Create Purchase Order
                </button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">

            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-[#E8F0EA] border border-[#5A8265]/30 text-[#5A8265] rounded-xl font-bold flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-[#5A8265] hover:text-gray-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Approved</p>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <h3 class="text-2xl font-black text-gray-800">{{ $approvedOrders ?? 0 }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div
                            class="w-10 h-10 rounded-full bg-[#FEF3C7] flex items-center justify-center text-[#D97706]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Pending Deliveries</p>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <h3 class="text-2xl font-black text-gray-800">{{ $pendingDeliveries ?? 0 }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div
                            class="w-10 h-10 rounded-full bg-[#E8F0EA] flex items-center justify-center text-[#5A8265]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402 2.599-1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Total Spent</p>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <h3 class="text-2xl font-black text-gray-800">₱{{ number_format($totalSpent ?? 0, 2) }}</h3>
                    </div>
                </div>

            </div>

            <form method="GET" action="{{ route('purchases.index') }}" id="filter-form" class="bg-white rounded-t-2xl border border-gray-200 border-b-0 px-6 pt-2 flex flex-col md:flex-row items-end justify-between gap-4">
                <input type="hidden" name="status" id="status_filter" value="{{ request('status', 'All') }}">

                <div class="flex space-x-6 overflow-x-auto w-full md:w-auto" id="order-tabs">
                    <button type="button" onclick="document.getElementById('status_filter').value='All'; document.getElementById('filter-form').submit();"
                        class="tab-btn py-4 text-sm whitespace-nowrap transition-colors {{ request('status', 'All') == 'All' ? 'border-b-2 border-[#5A8265] text-[#5A8265] font-bold' : 'border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium' }}">
                        All Orders <span class="ml-1 bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs">{{ $allCount ?? 0 }}</span>
                    </button>
                    <button type="button" onclick="document.getElementById('status_filter').value='Pending'; document.getElementById('filter-form').submit();"
                        class="tab-btn py-4 text-sm whitespace-nowrap transition-colors {{ request('status') == 'Pending' ? 'border-b-2 border-[#5A8265] text-[#5A8265] font-bold' : 'border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium' }}">
                        Pending <span class="ml-1 bg-gray-100 py-0.5 px-2 rounded-full text-xs">{{ $pendingCount ?? 0 }}</span>
                    </button>
                    <button type="button" onclick="document.getElementById('status_filter').value='Received'; document.getElementById('filter-form').submit();"
                        class="tab-btn py-4 text-sm whitespace-nowrap transition-colors {{ request('status') == 'Received' ? 'border-b-2 border-[#5A8265] text-[#5A8265] font-bold' : 'border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium' }}">
                        Received <span class="ml-1 bg-gray-100 py-0.5 px-2 rounded-full text-xs">{{ $receivedCount ?? 0 }}</span>
                    </button>
                    <button type="button" onclick="document.getElementById('status_filter').value='Cancelled'; document.getElementById('filter-form').submit();"
                        class="tab-btn py-4 text-sm whitespace-nowrap transition-colors {{ request('status') == 'Cancelled' ? 'border-b-2 border-red-500 text-red-500 font-bold' : 'border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium' }}">
                        Delayed/Cancelled <span class="ml-1 bg-gray-100 py-0.5 px-2 rounded-full text-xs">{{ $cancelledCount ?? 0 }}</span>
                    </button>
                </div>

                <div class="flex items-center gap-3 pb-3 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search PO or Supplier..."
                            class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] focus:border-[#5A8265]">
                    </div>
                    <select name="supplier" onchange="this.form.submit()"
                        class="py-2 pl-3 pr-8 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] text-gray-600 appearance-none">
                        <option value="All" {{ request('supplier') == 'All' ? 'selected' : '' }}>All Suppliers</option>
                        <option value="AgriCorp Philippines" {{ request('supplier') == 'AgriCorp Philippines' ? 'selected' : '' }}>AgriCorp Philippines</option>
                        <option value="GreenEarth Co." {{ request('supplier') == 'GreenEarth Co.' ? 'selected' : '' }}>GreenEarth Co.</option>
                        <option value="FarmTech Supplies" {{ request('supplier') == 'FarmTech Supplies' ? 'selected' : '' }}>FarmTech Supplies</option>
                    </select>
                    
                    @if(request('search') || (request('status') && request('status') != 'All') || (request('supplier') && request('supplier') != 'All'))
                        <a href="{{ route('purchases.index') }}" class="text-xs text-red-500 font-bold hover:underline whitespace-nowrap ml-2">Clear</a>
                    @endif
                </div>
            </form>

            <div class="bg-white border border-gray-200 rounded-b-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="main-orders-table">
                        <thead>
                            <tr
                                class="bg-gray-50/50 border-b border-gray-200 text-[11px] uppercase tracking-wider text-gray-500 font-bold">
                                <th class="px-6 py-4">PO Number</th>
                                <th class="px-6 py-4">Supplier</th>
                                <th class="px-6 py-4">Order Date</th>
                                <th class="px-6 py-4">Expected Delivery</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Total Amount</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table-body" class="divide-y divide-gray-100 text-sm">

                            @forelse($purchaseOrders as $po)
                                @php
                                    if ($po->status === 'Pending') {
                                        $statusBadge =
                                            '<span class="text-xs font-extrabold uppercase tracking-wider text-[#D97706]">Pending</span>';
                                    } elseif ($po->status === 'Received') {
                                        $statusBadge =
                                            '<span class="text-xs font-extrabold uppercase tracking-wider text-[#5A8265]">Received</span>';
                                    } else {
                                        $statusBadge =
                                            '<span class="text-xs font-extrabold uppercase tracking-wider text-[#DC2626]">' .
                                            $po->status .
                                            '</span>';
                                    }
                                @endphp
                                <tr class="po-row hover:bg-gray-50/50 transition-colors group">

                                    <td class="px-6 py-4 font-bold text-gray-800">{{ $po->po_number }}</td>
                                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $po->supplier }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $po->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $po->expected_delivery ? \Carbon\Carbon::parse($po->expected_delivery)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">{!! $statusBadge !!}</td>
                                    <td class="px-6 py-4 text-right font-black text-gray-800">
                                        ₱{{ number_format($po->total_amount, 2) }}</td>
                                    <td class="px-6 py-4 text-right space-x-1">
                                        <button type="button"
                                            onclick='openDetailsDrawer(@json($po))'
                                            class="px-3 py-1.5 text-xs font-bold text-gray-600 border border-gray-200 hover:bg-gray-100 rounded-lg transition-colors">View</button>
                                        <button type="button" onclick='openTrackDrawer(@json($po))'
                                            class="px-3 py-1.5 text-xs font-bold text-[#5A8265] border border-[#5A8265]/30 hover:bg-[#E8F0EA] rounded-lg transition-colors">Track</button>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-state">
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-400">No orders found
                                        matching your filters.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4 bg-gray-50/50">
                    {{ $purchaseOrders->links() }}
                </div>
            </div>

        </div>
    </main>

    <div id="modal-backdrop"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 sm:p-6 transition-opacity duration-300 opacity-0">
        <div id="modal-create-po"
            class="purchasing-modal hidden bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-full flex-col transform scale-95 transition-all duration-300 relative">
            <button type="button" onclick="closeModals()"
                class="absolute top-5 right-5 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full p-2 transition-colors z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="px-8 py-6 bg-[#5A8265] flex-shrink-0 rounded-t-2xl">
                <h3 class="text-xl font-extrabold text-white">Create Purchase Order</h3>
                <p class="text-sm text-[#E8F0EA] mt-1">Generate a new PO to restock inventory from suppliers.</p>
            </div>

            <form action="{{ route('purchases.store') }}" method="POST"
                class="flex-1 overflow-y-auto custom-scrollbar flex flex-col md:flex-row pb-24">
                @csrf
                <input type="hidden" name="total_amount" id="hidden-total-amount" value="0.00">

                <div class="w-full md:w-1/3 p-8 border-r border-gray-100 bg-gray-50/30 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Select
                            Supplier <span class="text-red-500">*</span></label>
                        <div id="supplier-select-view" class="flex items-center gap-2">
                            <select name="supplier" id="modal-supplier-select"
                                class="flex-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] transition-all bg-white">
                                <option value="AgriCorp Philippines">AgriCorp Philippines</option>
                                <option value="GreenEarth Co.">GreenEarth Co.</option>
                                <option value="FarmTech Supplies">FarmTech Supplies</option>
                            </select>
                            <button type="button" onclick="toggleNewSupplierForm(true)"
                                class="px-3 py-2.5 bg-[#E8F0EA] text-[#5A8265] hover:bg-[#5A8265] hover:text-white rounded-lg transition-colors border border-[#5A8265]/20 font-bold text-sm whitespace-nowrap shadow-sm"
                                title="Add New Supplier">New</button>
                        </div>
                        <div id="supplier-new-view" class="hidden flex items-center gap-2">
                            <input type="text" id="new-supplier-input" placeholder="Enter supplier name..."
                                class="flex-1 border border-[#5A8265] rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 bg-white">
                            <button type="button" onclick="saveNewSupplier()"
                                class="px-3 py-2.5 bg-[#5A8265] text-white hover:bg-[#4A6B53] rounded-lg transition-colors font-bold text-sm shadow-sm">Save</button>
                            <button type="button" onclick="toggleNewSupplierForm(false)"
                                class="px-3 py-2.5 bg-white text-gray-500 border border-gray-200 hover:bg-gray-50 rounded-lg transition-colors font-bold text-sm">✕</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Order
                                Date</label>
                            <input type="date" value="{{ date('Y-m-d') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] bg-gray-50"
                                readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Expected
                                By</label>
                            <input type="date" name="expected_delivery"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Order Notes
                            / Terms</label>
                        <textarea rows="4" placeholder="Add any special instructions or delivery terms here..."
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] transition-all resize-none"></textarea>
                    </div>
                </div>

                <div class="w-full md:w-2/3 p-8 flex flex-col">
                    <div class="flex justify-between items-end mb-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Order
                            Items</label>
                        <button type="button" onclick="addRow()"
                            class="text-sm font-bold text-[#5A8265] hover:text-[#4A6B53] flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg> Add Row
                        </button>
                    </div>

                    <datalist id="inventory-items">
    @foreach($products as $product)
        <option value="{{ $product->name }}">{{ $product->category }} - Current Stock: {{ $product->stock }}</option>
    @endforeach
</datalist>

<div class="border border-gray-200 rounded-xl overflow-hidden mb-6 flex-shrink-0">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-xs font-bold text-gray-500">Item Name</th>
                <th class="px-4 py-3 text-xs font-bold text-gray-500 w-24">Qty</th>
                <th class="px-4 py-3 text-xs font-bold text-gray-500 w-32">Unit Cost (₱)</th>
                <th class="px-4 py-3 text-xs font-bold text-gray-500 w-32 text-right">Total</th>
                <th class="px-4 py-3 w-10"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100" id="po-items-tbody">
            <tr>
                <td class="px-4 py-2">
                    <input type="text" name="item_names[]" list="inventory-items" autocomplete="off" placeholder="Type to search inventory items..."
                        class="w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:border-[#5A8265] text-gray-800"
                        required>
                </td>
                <td class="px-4 py-2">
                    <input type="number" name="quantities[]" value="1" min="1"
                        oninput="calculateTotals()"
                        class="qty-input w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:border-[#5A8265] hide-arrows text-center"
                        required>
                </td>
                <td class="px-4 py-2">
                    <input type="number" name="unit_prices[]" value="0.00" step="0.01"
                        min="0" oninput="calculateTotals()"
                        class="cost-input w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:border-[#5A8265] hide-arrows"
                        required>
                </td>
                <td class="px-4 py-2 text-right font-bold text-gray-800 row-total">0.00</td>
                <td class="px-4 py-2 text-center text-gray-400 hover:text-red-500 cursor-pointer"
                    onclick="removeRow(this)">
                    <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </td>
            </tr>
        </tbody>
    </table>
</div>

                    <div class="flex justify-end mt-2">
                        <div class="w-72 bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-4 shadow-sm">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span class="font-medium">Subtotal</span>
                                <span id="calc-subtotal" class="font-bold">₱0.00</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 items-center">
                                <span class="font-medium">Shipping / Fees</span>
                                <input type="number" id="calc-shipping" value="0.00" step="0.01"
                                    oninput="calculateTotals()"
                                    class="w-24 border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:border-[#5A8265] text-right hide-arrows bg-white">
                            </div>
                            <div
                                class="flex justify-between text-lg font-black text-gray-800 pt-4 border-t border-gray-200">
                                <span>Total</span>
                                <span id="calc-total" class="text-[#5A8265]">₱0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="absolute bottom-0 left-0 w-full px-8 py-5 border-t border-gray-100 flex items-center justify-end gap-3 bg-white rounded-b-2xl shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                    <button type="button" onclick="closeModals()"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 rounded-xl transition-colors shadow-sm">Cancel</button>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-colors shadow-md">Create
                        Order</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-cancel-po"
        class="purchasing-modal hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[160] items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-sm flex flex-col transform transition-all duration-300">
            <div class="p-6 text-center">
                <div
                    class="w-14 h-14 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4 border border-red-200">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 id="cancel-modal-title" class="text-lg font-bold text-gray-900 mb-2">Cancel Order?</h3>
                <p id="cancel-modal-desc" class="text-sm text-gray-500">Are you sure you want to cancel and delete
                    this order? This action cannot be undone.</p>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 rounded-b-2xl flex gap-3">
                <button type="button" onclick="closeCancelModal()"
                    class="flex-1 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors shadow-sm">No,
                    Keep It</button>
                <form id="cancelPoForm" method="POST" class="flex-1 m-0">
                    @csrf
                    @method('DELETE')
                    <button id="cancel-modal-btn" type="submit"
                        class="w-full py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors shadow-sm">Yes,
                        Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div id="drawer-backdrop"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[110] hidden transition-opacity duration-300 opacity-0"
        onclick="closeDrawer()"></div>

    <div id="drawer-track"
        class="fixed top-0 right-0 h-full w-full max-w-md bg-white shadow-2xl z-[120] transform translate-x-full transition-transform duration-300 flex flex-col drawer-panel">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-xl font-extrabold text-gray-800">Track Order</h3>
                <p id="track-po-number" class="text-sm font-bold text-[#5A8265] mt-0.5">PO-2026-000</p>
            </div>
            <button type="button" onclick="closeDrawer()"
                class="text-gray-400 hover:text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="p-6 flex-1 overflow-y-auto custom-scrollbar">
            <div class="mb-6">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Supplier</p>
                <p id="track-supplier" class="text-base font-bold text-gray-800">Supplier Name</p>
            </div>

            <div class="relative border-l-2 border-gray-200 ml-3 mt-8 space-y-8 pb-8">
                <div class="relative pl-6">
                    <div
                        class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-[#5A8265] border-4 border-white shadow">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Order Placed</h4>
                        <p class="text-xs text-gray-500 mt-0.5">PO was generated and sent to supplier.</p>
                        <p id="track-created-date" class="text-xs font-medium text-gray-400 mt-1">Date</p>
                    </div>
                </div>
                <div class="relative pl-6">
                    <div
                        class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-[#5A8265] border-4 border-white shadow">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Processing</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Supplier has confirmed and is packing items.</p>
                    </div>
                </div>
                <div class="relative pl-6" id="status-shipped-container">
                    <div
                        class="absolute -left-[11px] top-0 w-5 h-5 rounded-full bg-[#F59E0B] border-4 border-white shadow animate-pulse">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#D97706]">Shipped / In Transit</h4>
                        <p class="text-xs text-gray-600 mt-0.5">Order is on the way via delivery truck.</p>
                    </div>
                </div>
                <div class="relative pl-6">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-gray-200 border-4 border-white">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-400">Expected Delivery</h4>
                        <p class="text-xs text-gray-400 mt-0.5">Estimated arrival at your warehouse.</p>
                        <p id="track-expected-date" class="text-xs font-medium text-gray-400 mt-1">Date</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="drawer-actions-container" class="p-6 border-t border-gray-100 bg-gray-50 space-y-3">
        </div>
    </div>

    <div id="drawer-details"
        class="fixed top-0 right-0 h-full w-full max-w-xl bg-white shadow-2xl z-[120] transform translate-x-full transition-transform duration-300 flex flex-col drawer-panel">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#2C4A3E] text-white">
            <div>
                <h3 class="text-xl font-extrabold">Order Details</h3>
                <p id="details-po-number" class="text-sm font-medium text-[#A6BBAA] mt-0.5">PO-2026-000</p>
            </div>
            <button type="button" onclick="closeDrawer()"
                class="text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="p-6 flex-1 overflow-y-auto custom-scrollbar bg-gray-50/50">
            <div
                class="bg-white rounded-xl border border-gray-200 p-5 mb-6 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Supplier</p>
                    <p id="details-supplier" class="text-lg font-bold text-gray-800">Supplier Name</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Status</p>
                    <div id="details-status-badge"></div>
                </div>
            </div>

            <h4 class="text-sm font-bold text-gray-800 mb-3 uppercase tracking-wider">Items Ordered</h4>
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 font-bold uppercase">
                        <tr>
                            <th class="px-4 py-3">Item Description</th>
                            <th class="px-4 py-3 text-center">Qty</th>
                            <th class="px-4 py-3 text-right">Unit Price</th>
                            <th class="px-4 py-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="details-items-body">
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end">
                <div class="w-64 space-y-2 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span id="details-subtotal" class="font-bold text-gray-800">₱0.00</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping/Fees</span>
                        <span class="font-bold text-gray-800">N/A</span>
                    </div>
                    <div
                        class="flex justify-between text-lg font-black text-gray-900 pt-2 border-t border-gray-200 mt-2">
                        <span>Grand Total</span>
                        <span id="details-total" class="text-[#5A8265]">₱0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="logoutModal" class="fixed inset-0 z-[200] hidden print:hidden" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border-t-4 border-[#5A8265]">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#E8F0EA] sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-[#5A8265]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Ready to leave?
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to log out of your account?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-lg bg-[#5A8265] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#4A6B53] sm:ml-3 sm:w-auto transition-colors">
                                Yes, Log Out
                            </button>
                        </form>
                        <button type="button" onclick="closeLogoutModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTab = 'all';

        function exportTableToCSV(filename) {
            let csv = [];
            let rows = document.querySelectorAll("#main-orders-table tr");
            for (let i = 0; i < rows.length; i++) {
                if (rows[i].id === 'empty-state' || rows[i].style.display === 'none') continue;
                let row = [],
                    cols = rows[i].querySelectorAll("td, th");
                for (let j = 0; j < cols.length - 1; j++) {
                    let data = cols[j].innerText.replace(/"/g, '""');
                    row.push('"' + data + '"');
                }
                if (row.length > 0) csv.push(row.join(","));
            }
            downloadCSV(csv.join("\n"), filename);
        }

        function downloadCSV(csv, filename) {
            let csvFile = new Blob([csv], {
                type: "text/csv"
            });
            let downloadLink = document.createElement("a");
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        function toggleNewSupplierForm(show) {
            const selectView = document.getElementById('supplier-select-view');
            const newView = document.getElementById('supplier-new-view');
            const inputField = document.getElementById('new-supplier-input');

            if (show) {
                selectView.classList.add('hidden');
                newView.classList.remove('hidden');
                inputField.value = '';
                inputField.focus();
            } else {
                newView.classList.add('hidden');
                selectView.classList.remove('hidden');
            }
        }

        function saveNewSupplier() {
            const inputField = document.getElementById('new-supplier-input');
            const newSupplier = inputField.value.trim();

            if (newSupplier !== "") {
                let modalSelect = document.getElementById('modal-supplier-select');
                let option = document.createElement("option");
                option.text = newSupplier;
                option.value = newSupplier;
                modalSelect.add(option);
                modalSelect.value = newSupplier;

                let filterSelect = document.getElementById('supplier-select');
                if (filterSelect) {
                    let filterOpt = document.createElement("option");
                    filterOpt.text = newSupplier;
                    filterOpt.value = newSupplier;
                    filterSelect.add(filterOpt);
                }
                toggleNewSupplierForm(false);
            }
        }

        function addRow() {
    const tbody = document.getElementById('po-items-tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td class="px-4 py-2">
            <input type="text" name="item_names[]" list="inventory-items" autocomplete="off" placeholder="Type to search inventory items..." class="w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:border-[#5A8265] text-gray-800" required>
        </td>
        <td class="px-4 py-2">
            <input type="number" name="quantities[]" value="1" min="1" oninput="calculateTotals()" class="qty-input w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:border-[#5A8265] hide-arrows text-center" required>
        </td>
        <td class="px-4 py-2">
            <input type="number" name="unit_prices[]" value="0.00" min="0" step="0.01" oninput="calculateTotals()" class="cost-input w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:border-[#5A8265] hide-arrows" required>
        </td>
        <td class="px-4 py-2 text-right font-bold text-gray-800 row-total">0.00</td>
        <td class="px-4 py-2 text-center text-gray-400 hover:text-red-500 cursor-pointer" onclick="removeRow(this)">
            <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </td>
    `;
    tbody.appendChild(newRow);
    calculateTotals();
}

        function removeRow(element) {
            element.closest('tr').remove();
            calculateTotals();
        }

        function calculateTotals() {
            const tbody = document.getElementById('po-items-tbody');
            const rows = tbody.querySelectorAll('tr');
            let subtotal = 0;

            rows.forEach(row => {
                const qtyInput = row.querySelector('.qty-input');
                const costInput = row.querySelector('.cost-input');
                const totalCell = row.querySelector('.row-total');

                if (qtyInput && costInput && totalCell) {
                    const qty = parseFloat(qtyInput.value) || 0;
                    const cost = parseFloat(costInput.value) || 0;
                    const rowTotal = qty * cost;

                    totalCell.textContent = rowTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    if (rowTotal > 0) totalCell.classList.remove('text-gray-400');
                    else totalCell.classList.add('text-gray-400');

                    subtotal += rowTotal;
                }
            });

            document.getElementById('calc-subtotal').textContent = '₱' + subtotal.toFixed(2).replace(
                /\B(?=(\d{3})+(?!\d))/g, ",");

            const shipping = parseFloat(document.getElementById('calc-shipping').value) || 0;
            const grandTotal = subtotal + shipping;

            document.getElementById('calc-total').textContent = '₱' + grandTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g,
                ",");
            document.getElementById('hidden-total-amount').value = grandTotal.toFixed(2);
        }

        function applyFilters() {
            const searchVal = document.getElementById('search-input').value.toLowerCase();
            const supplierVal = document.getElementById('supplier-select').value;
            const rows = document.querySelectorAll('.po-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status').toLowerCase();
                const rowSupplier = row.getAttribute('data-supplier');
                const rowSearch = row.getAttribute('data-search');

                let show = true;

                if (currentTab !== 'all') {
                    const tab = currentTab.toLowerCase();
                    if (tab === 'cancelled') {
                        if (rowStatus !== 'cancelled' && rowStatus !== 'canceled' && rowStatus !== 'delayed') {
                            show = false;
                        }
                    } else {
                        if (rowStatus !== tab) show = false;
                    }
                }

                if (supplierVal !== 'All' && rowSupplier !== supplierVal) show = false;
                if (searchVal && !rowSearch.includes(searchVal)) show = false;

                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            const emptyState = document.getElementById('empty-state');
            if (emptyState) emptyState.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
            document.getElementById('table-entries-info').textContent = `Showing ${visibleCount} entries`;
        }

        function setTab(tabName) {
            currentTab = tabName;
            document.querySelectorAll('.tab-btn').forEach(tab => {
                tab.classList.remove('border-[#5A8265]', 'text-[#5A8265]', 'font-bold');
                tab.classList.add('border-transparent', 'text-gray-500', 'font-medium');
            });
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.remove('border-transparent', 'text-gray-500', 'font-medium');
            activeTab.classList.add('border-[#5A8265]', 'text-[#5A8265]', 'font-bold');
            applyFilters();
        }

        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalCreatePo = document.getElementById('modal-create-po');
        const modalCancelPo = document.getElementById('modal-cancel-po');
        const drawerBackdrop = document.getElementById('drawer-backdrop');

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modalId === 'modal-create-po') {
                modalBackdrop.classList.remove('hidden');
                modalBackdrop.classList.add('flex');
            }

            setTimeout(() => {
                if (modalId === 'modal-create-po') {
                    modalBackdrop.classList.remove('opacity-0');
                    modalBackdrop.classList.add('opacity-100');
                }
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    modal.classList.replace('scale-95', 'scale-100');
                }, 10);
            }, 10);
        }

        function closeModals() {
            modalCreatePo.classList.replace('scale-100', 'scale-95');
            modalBackdrop.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => {
                modalBackdrop.classList.add('hidden');
                modalBackdrop.classList.remove('flex');
                modalCreatePo.classList.add('hidden');
                modalCreatePo.classList.remove('flex');
            }, 300);
        }

        // This function dynamically handles BOTH cancelling AND deleting based on the argument passed
        function openCancelModal(poId, actionType = 'cancel') {
            document.getElementById('cancelPoForm').action = `/purchases/${poId}`;

            const modalTitle = document.getElementById('cancel-modal-title');
            const modalDesc = document.getElementById('cancel-modal-desc');
            const modalBtn = document.getElementById('cancel-modal-btn');

            if (actionType === 'delete') {
                modalTitle.textContent = 'Permanently Delete Record?';
                modalDesc.textContent =
                    'Are you sure you want to permanently delete this cancelled order from your database? This action cannot be undone.';
                modalBtn.textContent = 'Yes, Delete';
            } else {
                modalTitle.textContent = 'Cancel Order?';
                modalDesc.textContent =
                'Are you sure you want to cancel this order? It will be moved to the Cancelled tab.';
                modalBtn.textContent = 'Yes, Cancel';
            }

            closeAllDrawers();
            openModal('modal-cancel-po');
        }

        function closeCancelModal() {
            modalCancelPo.classList.replace('scale-100', 'scale-95');
            setTimeout(() => {
                modalCancelPo.classList.add('hidden');
                modalCancelPo.classList.remove('flex');
            }, 300);
        }

        function openTrackDrawer(po) {
            closeAllDrawers();
            const drawerTrack = document.getElementById('drawer-track');

            document.getElementById('track-po-number').textContent = po.po_number;
            document.getElementById('track-supplier').textContent = po.supplier;

            const createdDate = new Date(po.created_at);
            document.getElementById('track-created-date').textContent = createdDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

            if (po.expected_delivery) {
                const expDate = new Date(po.expected_delivery);
                document.getElementById('track-expected-date').textContent = expDate.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
            } else {
                document.getElementById('track-expected-date').textContent = 'N/A';
            }

            const actionsContainer = document.getElementById('drawer-actions-container');
            actionsContainer.innerHTML = '';

            // THIS IS THE NEW LOGIC TO SWAP THE BUTTONS
            const poStatusLower = po.status.toLowerCase();

            if (po.status === 'Pending') {
                actionsContainer.innerHTML += `
                    <form action="/purchases/${po.id}/receive" method="POST" class="m-0">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <button type="submit" class="w-full py-3 text-sm font-bold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-colors shadow-md">Mark as Delivered</button>
                    </form>
                `;
                actionsContainer.innerHTML += `
                    <button type="button" onclick="openCancelModal(${po.id}, 'cancel')" class="w-full py-3 text-sm font-bold text-[#DC2626] bg-white border border-[#DC2626]/20 hover:bg-[#FEE2E2] rounded-xl transition-colors">Cancel Order</button>
                `;
            } else if (poStatusLower === 'cancelled' || poStatusLower === 'canceled' || poStatusLower === 'delayed') {
                actionsContainer.innerHTML += `
                    <button type="button" onclick="openCancelModal(${po.id}, 'delete')" class="w-full py-3 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Permanently Delete
                    </button>
                `;
            }

            showDrawer(drawerTrack);
        }

        function openDetailsDrawer(po) {
            closeAllDrawers();
            const drawerDetails = document.getElementById('drawer-details');

            const totalAmount = parseFloat(po.total_amount || 0);
            const cashFormatted = '₱' + totalAmount.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            const items = po.items || po.details || po.order_items || po.products || [];

            document.getElementById('details-po-number').textContent = po.po_number;
            document.getElementById('details-supplier').textContent = po.supplier;
            document.getElementById('details-total').textContent = cashFormatted;
            document.getElementById('details-subtotal').textContent = cashFormatted;

            let badgeHtml = '';
            if (po.status === 'Pending') {
                badgeHtml = '<span class="text-xs font-extrabold uppercase tracking-wider text-[#D97706]">Pending</span>';
            } else if (po.status === 'Received') {
                badgeHtml = '<span class="text-xs font-extrabold uppercase tracking-wider text-[#5A8265]">Received</span>';
            } else {
                badgeHtml = '<span class="text-xs font-extrabold uppercase tracking-wider text-[#DC2626]">' + po.status +
                    '</span>';
            }
            document.getElementById('details-status-badge').innerHTML = badgeHtml;

            const itemsList = document.getElementById('details-items-body');
            itemsList.innerHTML = '';

            if (items.length > 0) {
                items.forEach(item => {
                    const name = item.item_name || item.name || item.product_name || item.description ||
                        'Unknown Item';
                    const cat = item.item_category || item.category || item.cat || '';
                    const qty = item.quantity || item.qty || 1;
                    const price = parseFloat(item.unit_price || item.price || item.cost || 0);
                    const amount = parseFloat(item.total_price || item.amount || item.total || (qty * price));

                    itemsList.innerHTML += `
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-800">${name}</p>
                                ${cat ? `<p class="text-xs text-gray-400 tracking-wide mt-0.5">${cat}</p>` : ''}
                            </td>
                            <td class="px-4 py-3 text-center">${qty}</td>
                            <td class="px-4 py-3 text-right text-gray-500">₱${price.toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                            <td class="px-4 py-3 text-right font-bold text-gray-800">₱${amount.toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                        </tr>
                    `;
                });
            } else {
                itemsList.innerHTML +=
                    `<tr><td colspan="4" class="p-8 text-center text-gray-500 text-sm">No items found for this order. (Create a new PO to see items here)</td></tr>`;
            }

            showDrawer(drawerDetails);
        }

        function showDrawer(drawerElement) {
            drawerBackdrop.classList.remove('hidden');
            drawerBackdrop.classList.add('block');
            setTimeout(() => {
                drawerBackdrop.classList.remove('opacity-0');
                drawerBackdrop.classList.add('opacity-100');
                drawerElement.classList.remove('translate-x-full');
            }, 10);
        }

        function closeAllDrawers() {
            document.querySelectorAll('.drawer-panel').forEach(drawer => {
                drawer.classList.add('translate-x-full');
            });
        }

        function closeDrawer() {
            closeAllDrawers();
            drawerBackdrop.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => {
                drawerBackdrop.classList.add('hidden');
                drawerBackdrop.classList.remove('block');
            }, 300);
        }

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        modalBackdrop.addEventListener('click', (e) => {
            if (e.target === modalBackdrop) closeModals();
        });

        applyFilters();
    </script>
</body>

</html>
