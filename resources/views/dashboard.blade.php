<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmtastic Dashboard</title>
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
                <a href="{{ route('sales.report') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('sales-report*') || Route::currentRouteName() == 'sales.report' ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('sales-report*') || Route::currentRouteName() == 'sales.report' ? 'opacity-90' : 'opacity-70' }}" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586A1 1 0 0113 3.414l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sales Reports</span>
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
            <a href="{{ route('sales.report') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('sales-report*') || Route::currentRouteName() == 'sales.report' ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('sales-report*') || Route::currentRouteName() == 'sales.report' ? 'opacity-90' : 'opacity-70' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586A1 1 0 0113 3.414l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sales Report</span>
            </a>
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
        class="flex-1 flex flex-col min-w-0 bg-[#F4F7F6] pl-[80px] md:pl-0 transition-all duration-300 overflow-hidden">

        <header
            class="bg-white h-[72px] border-b border-gray-200 flex items-center justify-end px-8 flex-shrink-0 z-10">
            <div class="flex items-center gap-5 text-gray-400">
                <button class="hover:text-gray-600 transition-colors relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    @if ($lowStockCount > 0)
                        <span
                            class="absolute top-0 right-0 w-2 h-2 bg-[#D97768] border-2 border-white rounded-full"></span>
                    @endif
                </button>
                <button class="hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">

            <div class="mb-6 flex justify-between items-end">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
                    <p class="text-sm text-gray-400 mt-1">Real-time insights for your farm supply business</p>
                </div>
                <div
                    class="text-sm font-medium text-gray-500 bg-gray-50 px-4 py-2.5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#5A8265]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ date('l, F j, Y') }}
                </div>
            </div>

            <div class="grid grid-cols-4 gap-6 mb-6">
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-full bg-[#E8F0EA] text-[#5A8265] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-medium text-gray-400">Est. Stock Value</p>
                            <h3 class="text-2xl font-extrabold text-gray-800 mt-0.5">
                                ₱{{ number_format($inventoryValue ?? 0, 2) }}</h3>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-end text-xs text-[#5A8265] font-bold pt-2 border-t border-gray-100">
                        {{ number_format($totalProducts ?? 0) }} total products in stock
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-full bg-[#FDF3E9] text-[#D97768] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-medium text-gray-400">Low Stock Items</p>
                            <h3 class="text-2xl font-extrabold text-[#D97768] mt-0.5">
                                {{ number_format($lowStockCount ?? 0) }}</h3>
                        </div>
                    </div>
                    <a href="/inventory"
                        class="flex items-center text-xs text-[#D97768] font-medium pt-2 border-t border-gray-100 cursor-pointer hover:underline">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        View inventory alerts
                    </a>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-full bg-[#E8F0EA] text-[#5A8265] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-medium text-gray-400">Active Rentals</p>
                            <h3 class="text-2xl font-extrabold text-gray-800 mt-0.5">
                                {{ class_exists('\App\Models\Rental') && \Illuminate\Support\Facades\Schema::hasTable('rentals') ? \App\Models\Rental::where('status', 'rented')->count() : 0 }}
                            </h3>
                        </div>
                    </div>
                    <a href="/rentals"
                        class="flex items-center text-xs text-gray-400 font-medium pt-2 border-t border-gray-100 cursor-pointer hover:text-gray-600">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        View rentals
                    </a>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-full bg-[#FDF3E9] text-[#D97768] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-medium text-gray-400">Pending Orders</p>
                            <h3 class="text-2xl font-extrabold text-gray-800 mt-0.5">
                                {{ number_format($pendingPurchases ?? 0) }}</h3>
                        </div>
                    </div>
                    <a href="/purchases"
                        class="flex items-center text-xs text-[#D97768] font-medium pt-2 border-t border-gray-100 cursor-pointer hover:underline">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        View orders
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6 mb-6">
                <div class="col-span-2 bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Recent Alerts</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Live stock updates from your system</p>
                        </div>
                        <a href="/inventory" class="text-xs text-[#5A8265] font-bold hover:underline">View All</a>
                    </div>

                    <div class="flex-1 space-y-5">
                        @forelse($lowStockItems as $item)
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-[#FDF3E9] text-[#D97768] flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-sm text-gray-800">
                                        @if ($item->stock == 0)
                                            Out of stock alert
                                        @else
                                            Low stock alert
                                        @endif
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $item->name }} • {{ $item->stock }}
                                        left in stock</p>
                                </div>
                                <span class="text-xs font-medium text-[#D97768]">Action Required</span>
                            </div>
                        @empty
                            <div
                                class="flex flex-col items-center justify-center h-full text-center text-gray-400 py-6">
                                <svg class="w-8 h-8 mb-2 opacity-30" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium">All systems normal.</p>
                                <p class="text-xs mt-1">No alerts or low stock items at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-span-1 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 text-lg mb-5">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="/pos"
                            class="w-full bg-[#5A8265] hover:bg-[#4A6B53] text-white py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            New Sale
                        </a>
                        <a href="/inventory"
                            class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Manage Stock
                        </a>
                        <a href="/purchases"
                            class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 14h6m-6 4h6m2-9h.01M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z">
                                </path>
                            </svg>
                            New Order
                        </a>
                        <a href="/rentals"
                            class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Rental Booking
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2 bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col">
                    <div class="mb-6">
                        <h3 class="font-bold text-gray-800 text-lg">Weekly Sales Performance</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Last 7 days revenue trend</p>
                    </div>

                    @php
                        // Mathematical prep for the bar chart
                        $maxDailySale = isset($last7Days) ? $last7Days->max('total') : 0;
                        if ($maxDailySale <= 0) {
                            $maxDailySale = 1;
                        } // prevent division by zero
                        $yAxisMax = ceil($maxDailySale / 1000) * 1000;
                        if ($yAxisMax == 0) {
                            $yAxisMax = 1000;
                        }
                    @endphp

                    <div class="relative pl-[44px] pr-2 pt-2 flex-1 flex flex-col h-[200px]">
                        <div
                            class="absolute left-0 top-0 bottom-6 w-10 flex flex-col justify-between text-[10px] text-gray-400">
                            <span
                                class="absolute top-[0%] -translate-y-1/2 right-2">{{ number_format($yAxisMax) }}</span>
                            <span
                                class="absolute top-[25%] -translate-y-1/2 right-2">{{ number_format($yAxisMax * 0.75) }}</span>
                            <span
                                class="absolute top-[50%] -translate-y-1/2 right-2">{{ number_format($yAxisMax * 0.5) }}</span>
                            <span
                                class="absolute top-[75%] -translate-y-1/2 right-2">{{ number_format($yAxisMax * 0.25) }}</span>
                            <span class="absolute top-[100%] -translate-y-1/2 right-2">0</span>
                        </div>

                        <div class="flex-1 relative border-b border-gray-100 mb-6">
                            <div class="absolute inset-0 z-0 pointer-events-none">
                                <div class="absolute top-[0%] left-0 right-0 border-t border-gray-100"></div>
                                <div class="absolute top-[25%] left-0 right-0 border-t border-gray-100"></div>
                                <div class="absolute top-[50%] left-0 right-0 border-t border-gray-100"></div>
                                <div class="absolute top-[75%] left-0 right-0 border-t border-gray-100"></div>
                            </div>

                            <div class="absolute inset-0 z-10 flex items-end justify-between gap-6">
                                @if (isset($last7Days))
                                    @foreach ($last7Days as $date => $data)
                                        @php
                                            $heightPercentage = ($data['total'] / $yAxisMax) * 100;
                                        @endphp
                                        <div class="w-full bg-[#678B71] hover:bg-[#5A8265] transition-colors rounded-t relative group cursor-pointer"
                                            style="height: {{ max($heightPercentage, 1) }}%;">
                                            <div
                                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block bg-gray-800 text-white text-[10px] py-1 px-2 rounded shadow-md whitespace-nowrap z-20">
                                                ₱{{ number_format($data['total'], 2) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div
                            class="absolute bottom-0 left-[44px] right-2 h-6 flex justify-between text-[11px] text-gray-400 items-end">
                            @if (isset($last7Days))
                                @foreach ($last7Days as $date => $data)
                                    <span class="w-full text-center">{{ $data['day'] }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-span-1 bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col">
                    <div class="mb-4">
                        <h3 class="font-bold text-gray-800 text-lg">Sales by Category</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Product distribution based on revenue</p>
                    </div>

                    @php
                        // Mathematical prep for the donut chart
                        $totalCatSales = isset($categorySales) ? $categorySales->sum('category_total') : 0;
                        if ($totalCatSales <= 0) {
                            $totalCatSales = 1;
                        } // prevent division by zero

                        // Set colors for specific categories
                        $colors = [
                            'Feeds' => '#678B71',
                            'Fertilizers' => '#A6BBAA',
                            'Seeds' => '#C2D1C5',
                            'Tools & Equipment' => '#C98A6C',
                            'Pesticides & Chemicals' => '#D97768',
                            'Others' => '#cbd5e1',
                        ];

                        $cumulativeOffset = 0;
                        $hasSales = isset($categorySales) && $categorySales->count() > 0;
                    @endphp

                    <div class="flex-1 flex flex-col items-center justify-center pt-2">
                        <div class="relative w-40 h-40 mb-8">
                            <svg viewBox="0 0 40 40" class="w-full h-full transform -rotate-90">
                                @if ($hasSales)
                                    @foreach ($categorySales as $index => $cat)
                                        @php
                                            $percent = round(($cat->category_total / $totalCatSales) * 100);
                                            $dashArray = $percent . ' ' . (100 - $percent);
                                            $dashOffset = -$cumulativeOffset;
                                            $cumulativeOffset += $percent;
                                            $catColor = $colors[$cat->category] ?? '#cbd5e1'; // fallback color
                                        @endphp
                                        <circle class="cursor-pointer transition-colors z-10 hover:opacity-80"
                                            stroke-width="8" stroke="{{ $catColor }}" fill="transparent"
                                            r="15.915" cx="20" cy="20"
                                            stroke-dasharray="{{ $dashArray }}"
                                            stroke-dashoffset="{{ $dashOffset }}">
                                            <title>{{ $cat->category }}: ₱{{ number_format($cat->category_total, 2) }}
                                            </title>
                                        </circle>
                                    @endforeach
                                @else
                                    <circle stroke-width="8" stroke="#f1f1f1" fill="transparent" r="15.915"
                                        cx="20" cy="20" stroke-dasharray="100 0"></circle>
                                @endif
                            </svg>

                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span class="text-[10px] text-gray-400 font-medium">Total Sales</span>
                                <span
                                    class="text-sm font-bold text-gray-700">₱{{ number_format(isset($categorySales) ? $categorySales->sum('category_total') : 0) }}</span>
                            </div>
                        </div>

                        <div class="w-full space-y-2.5">
                            @if ($hasSales)
                                @foreach ($categorySales as $cat)
                                    @php
                                        $percent = round(($cat->category_total / $totalCatSales) * 100);
                                        $catColor = $colors[$cat->category] ?? '#cbd5e1';
                                    @endphp
                                    <div class="flex justify-between text-xs items-center p-1 -mx-1">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <span class="w-2.5 h-2.5 rounded-full"
                                                style="background-color: {{ $catColor }};"></span>
                                            {{ $cat->category }}
                                        </div>
                                        <span class="font-bold">{{ $percent }}%</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-xs text-gray-400 py-4">No sales data yet. Complete a sale
                                    in the POS to see your chart!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div id="logoutModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
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
                                <svg class="h-6 w-6 text-[#5A8265]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </div>

                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Ready to leave?
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to log out of your account?
                                        Make sure you have finished your current transaction.</p>
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
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
</body>

</html>
