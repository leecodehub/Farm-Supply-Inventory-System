<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Overview - Farmtastic</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* PDF/Print style rules for the report */
        @media print {
            body {
                background: white;
            }

            body * {
                visibility: hidden;
            }

            #printable-report,
            #printable-report * {
                visibility: visible;
            }

            #printable-report {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none;
                box-shadow: none;
            }

            .no-print {
                display: none !important;
            }
        }

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

    <main
        class="flex-1 flex flex-col min-w-0 bg-[#F4F7F6] pl-[80px] md:pl-0 transition-all duration-300 overflow-hidden print:hidden">

        <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between flex-shrink-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Stock Overview</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your products, track inventory levels, and handle
                    restocking.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="printReport()"
                    class="px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Print Report
                </button>

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <button onclick="openModal('modal-add-item')"
                        class="px-4 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-all shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Add New Item
                    </button>
                @endif
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

            <div
                class="bg-white rounded-t-2xl border border-gray-200 border-b-0 px-6 pt-2 flex flex-col md:flex-row items-end justify-between gap-4">

                <div class="flex space-x-6 overflow-x-auto w-full md:w-auto" id="inventory-tabs">
                    <button onclick="setTab('all')" id="tab-all"
                        class="tab-btn border-b-2 border-[#5A8265] text-[#5A8265] font-bold py-4 text-sm whitespace-nowrap transition-colors">
                        All Stock
                    </button>
                    <button onclick="setTab('low')" id="tab-low"
                        class="tab-btn border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium py-4 text-sm whitespace-nowrap transition-colors">
                        Low Stock <span id="badge-low"
                            class="bg-[#FEF3C7] text-[#D97706] text-xs px-2 py-0.5 rounded-full ml-1 font-bold">0</span>
                    </button>
                    <button onclick="setTab('out')" id="tab-out"
                        class="tab-btn border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium py-4 text-sm whitespace-nowrap transition-colors">
                        Out of Stock <span id="badge-out"
                            class="bg-[#FEE2E2] text-[#DC2626] text-xs px-2 py-0.5 rounded-full ml-1 font-bold">0</span>
                    </button>
                </div>

                <form method="GET" action="/inventory" class="flex items-center gap-3 pb-3 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search item or SKU... (Press Enter)" class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] focus:border-[#5A8265]">
                    </div>
                    
                    <select name="category" onchange="this.form.submit()" class="py-2 pl-3 pr-8 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] text-gray-600 appearance-none">
                        <option value="All" {{ request('category') == 'All' ? 'selected' : '' }}>All Categories</option>
                        <option value="Feeds" {{ request('category') == 'Feeds' ? 'selected' : '' }}>Feeds</option>
                        <option value="Fertilizers" {{ request('category') == 'Fertilizers' ? 'selected' : '' }}>Fertilizers</option>
                        <option value="Seeds" {{ request('category') == 'Seeds' ? 'selected' : '' }}>Seeds</option>
                        <option value="Pesticides & Chemicals" {{ request('category') == 'Pesticides & Chemicals' ? 'selected' : '' }}>Pesticides & Chemicals</option>
                        <option value="Tools & Equipment" {{ request('category') == 'Tools & Equipment' ? 'selected' : '' }}>Tools & Equipment</option>
                        <option value="Others" {{ request('category') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>

                    @if(request('search') || (request('category') && request('category') != 'All'))
                        <a href="/inventory" class="text-xs text-red-500 font-bold hover:underline whitespace-nowrap ml-2">Clear</a>
                    @endif
                </form>
            </div>

            <div class="bg-white border border-gray-200 rounded-b-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto custom-scrollbar max-h-[calc(100vh-320px)] overflow-y-auto">
                    <table class="w-full text-left border-collapse" id="inventoryTable">
                        <thead class="bg-gray-50 sticky top-0 z-10 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
                            <tr class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-4 border-b border-gray-200">Item Details</th>
                                <th class="px-6 py-4 border-b border-gray-200">Category</th>
                                <th class="px-6 py-4 border-b border-gray-200">Stock Level</th>
                                <th class="px-6 py-4 border-b border-gray-200 text-right">Price</th>

                                @if (auth()->check() && auth()->user()->role === 'admin')
                                    <th class="px-6 py-4 border-b border-gray-200 text-center">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($products as $product)
                                @php
                                    if ($product->stock == 0) {
                                        $statusClass = 'out';
                                        $badgeClass = 'bg-[#FEE2E2] text-[#DC2626]';
                                        $statusText = 'Out of Stock';
                                        $barColor = 'bg-red-500';
                                    } elseif ($product->stock <= $product->alert_level) {
                                        $statusClass = 'low';
                                        $badgeClass = 'bg-[#FEF3C7] text-[#D97706]';
                                        $statusText = 'Low Stock';
                                        $barColor = 'bg-yellow-500';
                                    } else {
                                        $statusClass = 'in';
                                        $badgeClass = 'bg-[#E8F0EA] text-[#5A8265]';
                                        $statusText = 'In Stock';
                                        $barColor = 'bg-[#5A8265]';
                                    }
                                    $stockPercent = min(($product->stock / max($product->max_stock, 1)) * 100, 100);
                                @endphp
                                <tr class="item-row hover:bg-gray-50/50 transition-colors group"
                                    data-status="{{ $statusClass }}" data-category="{{ $product->category }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                                    class="w-12 h-12 rounded-lg object-cover border border-gray-200 bg-white shadow-sm">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 text-xs font-bold shadow-sm">
                                                    IMG</div>
                                            @endif
                                            <div>
                                                <div class="font-bold text-gray-800 product-name">{{ $product->name }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-0.5 font-mono product-sku">
                                                    {{ $product->sku }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $product->category }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="font-bold text-gray-800">{{ $product->stock }} <span
                                                    class="text-xs text-gray-400 font-normal">/
                                                    {{ $product->max_stock }}</span></span>
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $badgeClass }}">{{ $statusText }}</span>
                                        </div>
                                        <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="{{ $barColor }} h-1.5 rounded-full"
                                                style="width: {{ $stockPercent }}%"></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="font-bold text-gray-800">₱{{ number_format($product->price, 2) }}
                                        </div>
                                    </td>

                                    @if (auth()->check() && auth()->user()->role === 'admin')
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="openEditModal({{ $product }})"
                                                    class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 rounded-lg transition-colors shadow-sm"
                                                    title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <button
                                                    onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                                    class="p-2 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-800 rounded-lg transition-colors shadow-sm"
                                                    title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr id="empty-state">
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-medium">No products found in inventory.</p>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="empty-state-search" style="display: none;">
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <p class="text-sm font-medium">No items match your search or filter.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div> <div class="p-6 border-t border-gray-100 bg-white rounded-b-2xl">
                    {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="printable-report" class="hidden print:block p-8 bg-white text-black font-sans w-full">
        <div class="text-center mb-8 border-b border-gray-300 pb-4">
            <h1 class="text-3xl font-extrabold uppercase tracking-wider">Farmtastic</h1>
            <p class="text-sm text-gray-600 mt-1">Inventory & Stock Status Report</p>
            <p class="text-xs text-gray-500 mt-2">Generated on: <span id="report-date"></span></p>
            <p class="text-xs font-bold mt-1 text-[#5A8265]" id="report-type-text">All Items</p>
        </div>

        <table class="w-full text-left border-collapse text-sm mb-8">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 border border-gray-200">SKU</th>
                    <th class="p-3 border border-gray-200">Product Name</th>
                    <th class="p-3 border border-gray-200">Category</th>
                    <th class="p-3 border border-gray-200 text-right">Current Stock</th>
                    <th class="p-3 border border-gray-200 text-right">Unit Price</th>
                    <th class="p-3 border border-gray-200 text-right">Total Value</th>
                </tr>
            </thead>
            <tbody id="report-tbody">
            </tbody>
            <tfoot>
                <tr class="bg-gray-50 font-bold">
                    <td colspan="5" class="p-3 border border-gray-200 text-right">Total Inventory Value:</td>
                    <td class="p-3 border border-gray-200 text-right text-lg text-[#5A8265]" id="report-total-value">
                        ₱0.00</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="modal-backdrop"
        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[100] hidden transition-opacity duration-300"></div>

    <div id="modal-delete-item" class="inventory-modal fixed inset-0 z-[110] hidden items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md flex flex-col transform scale-95 transition-transform duration-300 overflow-hidden border-t-4 border-red-500">
            <div class="px-6 py-6 sm:flex sm:items-start">
                <div
                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-lg font-bold leading-6 text-gray-900">Delete Product</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to delete <span
                                id="delete_product_name" class="font-bold text-gray-800"></span>? This action will
                            permanently remove it from your inventory.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end gap-3 mt-auto border-t border-gray-100">
                <button type="button" onclick="closeModals()"
                    class="px-5 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl transition-colors shadow-sm">Cancel</button>
                <form id="deleteForm" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors shadow-md">Yes,
                        Delete It</button>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-add-item" class="inventory-modal fixed inset-0 z-[110] hidden items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col transform scale-95 transition-transform duration-300 overflow-hidden">
            <button onclick="closeModals()"
                class="absolute top-4 right-4 text-white/70 hover:text-white hover:bg-white/20 p-2 rounded-xl transition-colors z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div class="px-8 py-6 border-b border-gray-100 flex-shrink-0 bg-[#5A8265] rounded-t-2xl text-white">
                <h3 class="text-xl font-extrabold">Add New Item</h3>
                <p class="text-sm text-white/80 mt-1">Register a new product into your inventory.</p>
            </div>

            <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data"
                class="flex-1 overflow-y-auto custom-scrollbar flex flex-col">
                @csrf
                <div class="px-8 py-6 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product
                            Image</label>
                        <div class="flex items-center gap-4">
                            <div id="add-img-preview-container"
                                class="hidden w-16 h-16 rounded-lg bg-gray-50 border border-gray-200 overflow-hidden shadow-inner flex items-center justify-center">
                                <img id="add-img-preview" src="#" alt="Preview"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <input type="file" name="image" id="add-image-input" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#E8F0EA] file:text-[#5A8265] hover:file:bg-[#D9E6DB] cursor-pointer transition-colors"
                                    onchange="previewImage(this, 'add-img-preview', 'add-img-preview-container')">
                                <p class="text-[10px] text-gray-400 mt-1.5 font-medium">PNG, JPG or WEBP (Max. 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">SKU Code
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="sku" required placeholder="e.g. FERT-001"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product
                                Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required placeholder="e.g. Urea Fertilizer 50kg"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Category
                                <span class="text-red-500">*</span></label>
                            <select name="category" required
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                                <option value="" disabled selected>Select a category...</option>
                                <option value="Feeds">Feeds</option>
                                <option value="Fertilizers">Fertilizers</option>
                                <option value="Seeds">Seeds</option>
                                <option value="Pesticides & Chemicals">Pesticides & Chemicals</option>
                                <option value="Tools & Equipment">Tools & Equipment</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Selling
                                Price (₱) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" required min="0" step="0.01"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] hide-arrows font-bold text-gray-800">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 p-4 bg-[#E8F0EA] rounded-xl border border-[#5A8265]/20">
                        <div>
                            <label
                                class="block text-[10px] font-bold text-[#5A8265] uppercase tracking-wider mb-1">Initial
                                Stock</label>
                            <input type="number" name="stock" required min="0" value="0"
                                class="w-full border border-[#5A8265]/30 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] bg-white hide-arrows">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[#5A8265] uppercase tracking-wider mb-1">Max
                                Capacity</label>
                            <input type="number" name="max_stock" required min="1" value="100"
                                class="w-full border border-[#5A8265]/30 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] bg-white hide-arrows">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[#5A8265] uppercase tracking-wider mb-1">Low
                                Stock Alert</label>
                            <input type="number" name="alert_level" required min="1" value="10"
                                class="w-full border border-[#5A8265]/30 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] bg-white hide-arrows">
                        </div>
                    </div>
                </div>
                <div
                    class="px-8 py-5 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50 flex-shrink-0 mt-auto">
                    <button type="button" onclick="closeModals()"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl transition-colors shadow-sm">Cancel</button>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-colors shadow-md">Save
                        Product</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-edit-item" class="inventory-modal fixed inset-0 z-[110] hidden items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col transform scale-95 transition-transform duration-300 overflow-hidden">
            <button onclick="closeModals()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 hover:bg-gray-100 p-2 rounded-xl transition-colors z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div class="px-8 py-6 border-b border-gray-100 flex-shrink-0 bg-white">
                <h3 class="text-xl font-extrabold text-gray-800">Edit Product</h3>
                <p class="text-sm text-gray-500 mt-1">Update inventory details for <span
                        id="edit_product_name_display" class="font-bold"></span>.</p>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data"
                class="flex-1 overflow-y-auto custom-scrollbar flex flex-col">
                @csrf
                @method('PUT')
                <div class="px-8 py-6 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Update Image
                            (Optional)</label>
                        <div class="flex items-center gap-4">
                            <div id="edit-img-preview-container"
                                class="w-16 h-16 rounded-lg bg-gray-50 border border-gray-200 overflow-hidden shadow-inner flex items-center justify-center">
                                <img id="edit-img-preview" src="#" alt="Current"
                                    class="w-full h-full object-cover hidden">
                                <span id="edit-img-placeholder" class="text-xs font-bold text-gray-400">IMG</span>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="image" id="edit-image-input" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#E8F0EA] file:text-[#5A8265] hover:file:bg-[#D9E6DB] cursor-pointer transition-colors"
                                    onchange="previewImage(this, 'edit-img-preview', 'edit-img-preview-container', 'edit-img-placeholder')">
                                <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Leave empty to keep current
                                    image</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">SKU Code
                                <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_sku" name="sku" required
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] font-mono bg-gray-50"
                                readonly>
                            <p class="text-[10px] text-gray-400 mt-1">SKU cannot be changed.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product
                                Name <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_name" name="name" required
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Category
                                <span class="text-red-500">*</span></label>
                            <select id="edit_category" name="category" required
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                                <option value="Feeds">Feeds</option>
                                <option value="Fertilizers">Fertilizers</option>
                                <option value="Seeds">Seeds</option>
                                <option value="Pesticides & Chemicals">Pesticides & Chemicals</option>
                                <option value="Tools & Equipment">Tools & Equipment</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Selling
                                Price (₱) <span class="text-red-500">*</span></label>
                            <input type="number" id="edit_price" name="price" required min="0"
                                step="0.01"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] hide-arrows font-bold text-gray-800">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Current
                                Stock</label>
                            <input type="number" id="edit_stock" name="stock" required min="0"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white hide-arrows">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Max
                                Capacity</label>
                            <input type="number" id="edit_max_stock" name="max_stock" required min="1"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white hide-arrows">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Low
                                Alert</label>
                            <input type="number" id="edit_alert_level" name="alert_level" required min="1"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white hide-arrows">
                        </div>
                    </div>
                </div>
                <div
                    class="px-8 py-5 border-t border-gray-100 flex items-center justify-end gap-3 bg-white flex-shrink-0 mt-auto">
                    <button type="button" onclick="closeModals()"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl transition-colors shadow-sm">Cancel</button>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-md">Update
                        Product</button>
                </div>
            </form>
        </div>
    </div>

    <div id="logoutModal" class="fixed inset-0 z-[200] hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border-t-4 border-[#5A8265]">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#E8F0EA] sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-[#5A8265]" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
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

        // TABS LOGIC
        function setTab(tab) {
            currentTab = tab;

            // Reset tab styling
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-[#5A8265]', 'text-[#5A8265]', 'font-bold');
                btn.classList.add('border-transparent', 'text-gray-500', 'font-medium');
            });

            // Highlight selected tab
            const activeBtn = document.getElementById('tab-' + tab);
            activeBtn.classList.remove('border-transparent', 'text-gray-500', 'font-medium');
            activeBtn.classList.add('border-[#5A8265]', 'text-[#5A8265]', 'font-bold');

            filterTable();
        }

        // UNIFIED SEARCH AND FILTER LOGIC
        function filterTable() {
            const search = document.getElementById('search-input').value.toLowerCase();
            const category = document.getElementById('category-select').value;
            const rows = document.querySelectorAll('.item-row');

            let lowCount = 0;
            let outCount = 0;
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.querySelector('.product-name').textContent.toLowerCase();
                const sku = row.querySelector('.product-sku').textContent.toLowerCase();
                const rowCategory = row.getAttribute('data-category');
                const status = row.getAttribute('data-status');

                // Count overall badges regardless of search
                if (status === 'low') lowCount++;
                if (status === 'out') outCount++;

                // Check match
                const matchesSearch = name.includes(search) || sku.includes(search);
                const matchesCategory = category === 'All' || rowCategory === category;
                const matchesTab = currentTab === 'all' || status === currentTab;

                if (matchesSearch && matchesCategory && matchesTab) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update tab badges
            document.getElementById('badge-low').textContent = lowCount;
            document.getElementById('badge-out').textContent = outCount;

            // Handle Empty States
            const emptyState = document.getElementById('empty-state');
            const emptySearch = document.getElementById('empty-state-search');

            if (emptyState) emptyState.style.display = 'none';
            if (emptySearch) emptySearch.style.display = 'none';

            if (visibleCount === 0) {
                if (rows.length === 0 && emptyState) {
                    emptyState.style.display = '';
                } else if (emptySearch) {
                    emptySearch.style.display = '';
                }
            }

            // Update Report Label
            let reportText = "All Items";
            if (currentTab === 'in') reportText = "In Stock Items";
            if (currentTab === 'low') reportText = "Low Stock Items";
            if (currentTab === 'out') reportText = "Out of Stock Items";
            if (category !== 'All') reportText += ` - ${category}`;
            document.getElementById('report-type-text').textContent = reportText;
        }

        // INITIALIZE TABLE
        document.addEventListener('DOMContentLoaded', () => {
            filterTable();
        });

        // MODAL MANAGEMENT
        const backdrop = document.getElementById('modal-backdrop');

        function openModal(modalId) {
            document.querySelectorAll('.inventory-modal').forEach(m => {
                m.classList.replace('flex', 'hidden');
                m.classList.replace('scale-100', 'scale-95');
            });

            const modal = document.getElementById(modalId);
            backdrop.classList.remove('hidden');
            backdrop.classList.add('flex');
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            modal.classList.replace('hidden', 'flex');

            setTimeout(() => {
                modal.querySelector('div').classList.replace('scale-95', 'scale-100');
            }, 10);
        }

        function closeModals() {
            document.querySelectorAll('.inventory-modal').forEach(modal => {
                modal.querySelector('div').classList.replace('scale-100', 'scale-95');
            });

            setTimeout(() => {
                document.querySelectorAll('.inventory-modal').forEach(modal => {
                    modal.classList.replace('flex', 'hidden');
                });
                backdrop.classList.remove('flex');
                backdrop.classList.add('hidden');
            }, 300);
        }

        // IMAGE PREVIEW LOGIC
        function previewImage(input, imgId, containerId, placeholderId = null) {
            const file = input.files[0];
            const preview = document.getElementById(imgId);
            const container = document.getElementById(containerId);
            const placeholder = placeholderId ? document.getElementById(placeholderId) : null;

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    container.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                if (!placeholderId) container.classList.add('hidden');
                if (placeholder) placeholder.classList.remove('hidden');
            }
        }

        // OPENS EDIT MODAL AND POPULATES IT
        function openEditModal(product) {
            const form = document.getElementById('editForm');
            form.action = `/inventory/${product.id}`;

            document.getElementById('edit_product_name_display').textContent = product.name;
            document.getElementById('edit_sku').value = product.sku;
            document.getElementById('edit_name').value = product.name;
            document.getElementById('edit_category').value = product.category;
            document.getElementById('edit_price').value = product.price;
            document.getElementById('edit_stock').value = product.stock;
            document.getElementById('edit_max_stock').value = product.max_stock;
            document.getElementById('edit_alert_level').value = product.alert_level;

            // Handle image preview for edit
            const preview = document.getElementById('edit-img-preview');
            const placeholder = document.getElementById('edit-img-placeholder');
            document.getElementById('edit-image-input').value = '';

            if (product.image) {
                preview.src = `/storage/products/${product.image}`;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            openModal('modal-edit-item');
        }

        // OPENS THE CUSTOM DELETE MODAL
        function openDeleteModal(productId, productName) {
            const form = document.getElementById('deleteForm');
            form.action = `/inventory/${productId}`;
            document.getElementById('delete_product_name').textContent = productName;
            openModal('modal-delete-item');
        }

        // LOGOUT MODALS
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // PRINT REPORT LOGIC
        function printReport() {
            const now = new Date();
            document.getElementById('report-date').textContent = now.toLocaleString();

            const rows = document.querySelectorAll('.item-row');
            const reportTbody = document.getElementById('report-tbody');
            reportTbody.innerHTML = '';

            let totalValue = 0;

            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    const sku = row.querySelector('.product-sku').textContent;
                    const name = row.querySelector('.product-name').textContent;
                    const category = row.getAttribute('data-category');
                    const stockText = row.querySelector('.font-bold.text-gray-800').childNodes[0].textContent
                        .trim();
                    const stock = parseInt(stockText);
                    const price = parseFloat(row.querySelectorAll('.font-bold.text-gray-800')[1].textContent
                        .replace('₱', '').replace(',', ''));
                    const value = stock * price;

                    totalValue += value;

                    const reportRow = `
                        <tr class="border-b border-gray-200">
                            <td class="p-3 font-mono text-xs border border-gray-200">${sku}</td>
                            <td class="p-3 font-bold border border-gray-200">${name}</td>
                            <td class="p-3 border border-gray-200">${category}</td>
                            <td class="p-3 text-right border border-gray-200">${stock.toLocaleString()}</td>
                            <td class="p-3 text-right border border-gray-200">₱${price.toFixed(2)}</td>
                            <td class="p-3 text-right font-bold border border-gray-200 bg-gray-50">₱${value.toFixed(2)}</td>
                        </tr>
                    `;
                    reportTbody.insertAdjacentHTML('beforeend', reportRow);
                }
            });

            document.getElementById('report-total-value').textContent = `₱${totalValue.toFixed(2)}`;

            window.print();
        }
    </script>
</body>

</html>
