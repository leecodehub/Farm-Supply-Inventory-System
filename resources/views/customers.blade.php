<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Accounts - Farmtastic</title>
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
        class="w-[80px] hover:w-[260px] bg-[#2C4A3E] text-white flex flex-col h-full flex-shrink-0 z-20 transition-all duration-300 group overflow-hidden absolute md:relative shadow-xl print:hidden">

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
                <h2 class="text-2xl font-bold text-gray-800">Customer Accounts</h2>
                <p class="text-sm text-gray-500 mt-1">Manage client profiles, track balances, and assign account types.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modal-add-customer')"
                    class="px-4 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-all shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Customer
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

            <form method="GET" action="/customers" id="filter-form" class="mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
    
    <input type="hidden" name="status" id="status_filter" value="{{ request('status', 'All') }}">

    <div class="flex items-center gap-6 border-b border-gray-200 w-full md:w-auto">
        <button type="button" onclick="document.getElementById('status_filter').value='All'; document.getElementById('filter-form').submit();"
            class="tab-btn pb-3 text-sm transition-colors {{ request('status', 'All') == 'All' ? 'font-semibold border-b-2 border-[#5A8265] text-[#5A8265]' : 'font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700' }}">
            All Customers <span class="ml-1 bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs">{{ $allCount ?? 0 }}</span>
        </button>
        
        <button type="button" onclick="document.getElementById('status_filter').value='Active'; document.getElementById('filter-form').submit();"
            class="tab-btn pb-3 text-sm transition-colors {{ request('status') == 'Active' ? 'font-semibold border-b-2 border-[#5A8265] text-[#5A8265]' : 'font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700' }}">
            Active <span class="ml-1 bg-gray-100 py-0.5 px-2 rounded-full text-xs">{{ $activeCount ?? 0 }}</span>
        </button>
        
        <button type="button" onclick="document.getElementById('status_filter').value='Inactive'; document.getElementById('filter-form').submit();"
            class="tab-btn pb-3 text-sm transition-colors {{ request('status') == 'Inactive' ? 'font-semibold border-b-2 border-[#5A8265] text-[#5A8265]' : 'font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700' }}">
            Inactive <span class="ml-1 bg-gray-100 py-0.5 px-2 rounded-full text-xs">{{ $inactiveCount ?? 0 }}</span>
        </button>
    </div>

    <div class="flex items-center gap-3 w-full md:w-auto">
        
        <div class="relative flex-1 md:w-72">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customers... (Press Enter)" 
                class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] focus:border-[#5A8265]">
        </div>
        
        <select name="type" onchange="this.form.submit()" 
            class="py-2 pl-3 pr-8 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] text-gray-600 appearance-none shadow-sm hidden md:block">
            <option value="All" {{ request('type') == 'All' ? 'selected' : '' }}>All Types</option>
            <option value="Retail" {{ request('type') == 'Retail' ? 'selected' : '' }}>Retail</option>
            <option value="Wholesale" {{ request('type') == 'Wholesale' ? 'selected' : '' }}>Wholesale</option>
        </select>

        @if(request('search') || (request('type') && request('type') != 'All') || (request('status') && request('status') != 'All'))
            <a href="/customers" class="text-xs text-red-500 font-bold hover:underline whitespace-nowrap ml-2">Clear</a>
        @endif
        
    </div>
</form>

            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="customers-table">
                        <thead>
                            <tr
                                class="bg-white border-b border-gray-100 text-[11px] uppercase tracking-wider text-gray-400 font-bold">
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Contact</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm">

                            @forelse($customers as $customer)
                                @php
                                    // Text colors for Type (No background)
                                    $typeColor = $customer->type == 'Wholesale' ? 'text-purple-600' : 'text-blue-600';

                                    // Text colors for Status (No background, No toggle)
                                    $statusColor = $customer->status == 'Active' ? 'text-[#5A8265]' : 'text-gray-400';

                                    // Generate a deterministic color based on name length so avatars look colorful
                                    $colors = [
                                        'bg-blue-100 text-blue-600',
                                        'bg-green-100 text-green-600',
                                        'bg-yellow-100 text-yellow-600',
                                        'bg-pink-100 text-pink-600',
                                        'bg-indigo-100 text-indigo-600',
                                    ];
                                    $avatarColor = $colors[strlen($customer->name) % 5];
                                @endphp

                                <tr class="customer-row hover:bg-gray-50/80 transition-colors cursor-pointer"
                                    data-status="{{ $customer->status }}" data-type="{{ $customer->type }}"
                                    data-search="{{ strtolower($customer->name . ' ' . $customer->phone . ' ' . $customer->email) }}"
                                    onclick='openDrawer(@json($customer))'>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-full {{ $avatarColor }} flex items-center justify-center font-bold text-sm shrink-0 border border-white shadow-sm uppercase">
                                                {{ substr($customer->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">{{ $customer->name }}
                                                </p>
                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    {{ $customer->email ?? 'No email' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $customer->phone ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold {{ $typeColor }}">
                                            {{ $customer->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold {{ $statusColor }}">
                                            {{ $customer->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-gray-400 hover:text-gray-800 transition-colors p-1"
                                            onclick="event.stopPropagation(); openEditModal(@json($customer))">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                                </path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-state">
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div
                                            class="mx-auto w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-100">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="text-gray-900 font-bold mb-1">No customers found</h3>
                                        <p class="text-gray-500 text-sm">Add a new customer to start building your
                                            directory.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <div class="p-6 border-t border-gray-100 bg-white">
                    {{ $customers->links() }}
                </div>

        </div>
    </main>

    <div id="drawer-backdrop"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[90] hidden opacity-0 transition-opacity duration-300"
        onclick="closeDrawer()"></div>
    <div id="customer-drawer"
        class="fixed top-0 right-0 h-full w-full max-w-md bg-white shadow-2xl z-[100] transform translate-x-full transition-transform duration-300 flex flex-col print:hidden">

        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800">Customer Details</h3>
            <button onclick="closeDrawer()"
                class="text-gray-400 hover:text-gray-600 p-1 rounded-md hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-6">
            <div class="flex items-center gap-4 mb-8">
                <div id="drawer-avatar"
                    class="w-16 h-16 rounded-full bg-[#E8F0EA] text-[#5A8265] flex items-center justify-center text-2xl font-bold uppercase shadow-sm border border-[#5A8265]/20">
                    A
                </div>
                <div>
                    <h2 id="drawer-name" class="text-xl font-bold text-gray-900 leading-tight">Customer Name</h2>
                    <p id="drawer-email" class="text-sm text-gray-500 mt-1">email@example.com</p>
                    <div class="flex gap-4 mt-2">
                        <span id="drawer-type-badge"
                            class="text-xs font-bold uppercase tracking-wider text-blue-600">Retail</span>
                        <span id="drawer-status-badge"
                            class="text-xs font-bold uppercase tracking-wider text-[#5A8265]">Active</span>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Contact Information</h4>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 space-y-3">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span id="drawer-phone" class="text-sm text-gray-700 font-medium">N/A</span>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Account Balances</h4>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Current Balance</p>
                        <p id="drawer-balance" class="text-lg font-bold text-gray-900">₱0.00</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Credit Limit</p>
                        <p id="drawer-limit" class="text-lg font-bold text-gray-900">₱0.00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-100 bg-gray-50 flex gap-3">
            <button id="drawer-edit-btn"
                class="flex-1 py-2.5 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition-colors">Edit
                Customer</button>

            @if (auth()->check() && auth()->user()->role === 'admin')
                <button id="drawer-delete-btn"
                    class="flex-1 py-2.5 bg-red-50 border border-red-100 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors">Delete</button>
            @endif
        </div>
    </div>


    <div id="modal-backdrop"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[150] hidden items-center justify-center p-4 sm:p-6 transition-opacity duration-300 opacity-0 print:hidden">

        <div id="modal-add-customer"
            class="customer-modal hidden bg-white rounded-2xl shadow-2xl w-full max-w-[500px] flex flex-col transform scale-95 transition-all duration-300 relative">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Add New Customer</h3>
                <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('customers.store') }}" method="POST" class="flex flex-col">
                @csrf
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Customer Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Enter customer's full name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] placeholder-gray-400">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number</label>
                            <input type="text" name="phone" placeholder="e.g. +63 912 345 6789"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                            <input type="email" name="email" placeholder="name@company.com"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] placeholder-gray-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Account Type</label>
                            <select name="type"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                                <option value="Retail" selected>Retail</option>
                                <option value="Wholesale">Wholesale</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Account Status</label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Initial Balance</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">₱</span>
                                <input type="number" name="balance" step="0.01" value="0.00"
                                    class="w-full border border-gray-300 rounded-lg pl-7 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Credit Limit</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">₱</span>
                                <input type="number" name="credit_limit" step="0.01" value="0.00"
                                    class="w-full border border-gray-300 rounded-lg pl-7 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModals()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors shadow-sm">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-lg transition-colors shadow-sm">Save
                        Customer</button>
                </div>
            </form>
        </div>

        <div id="modal-edit-customer"
            class="customer-modal hidden bg-white rounded-2xl shadow-2xl w-full max-w-[500px] flex flex-col transform scale-95 transition-all duration-300 relative">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Edit Customer</h3>
                <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST" class="flex flex-col">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Customer Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="edit_name" name="name" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number</label>
                            <input type="text" id="edit_phone" name="phone"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                            <input type="email" id="edit_email" name="email"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Account Type</label>
                            <select id="edit_type" name="type"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                                <option value="Retail">Retail</option>
                                <option value="Wholesale">Wholesale</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Account Status</label>
                            <select id="edit_status" name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] bg-white">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Current Balance</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">₱</span>
                                <input type="number" id="edit_balance" name="balance" step="0.01"
                                    class="w-full border border-gray-300 rounded-lg pl-7 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Credit Limit</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">₱</span>
                                <input type="number" id="edit_credit_limit" name="credit_limit" step="0.01"
                                    class="w-full border border-gray-300 rounded-lg pl-7 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265]">
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModals()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors shadow-sm">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-lg transition-colors shadow-sm">Update</button>
                </div>
            </form>
        </div>

        <div id="modal-delete-customer"
            class="customer-modal hidden bg-white rounded-2xl shadow-xl w-full max-w-sm flex flex-col transform scale-95 transition-all duration-300 relative">
            <div class="p-6 text-center">
                <div
                    class="w-14 h-14 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4 border border-red-200">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Customer?</h3>
                <p class="text-sm text-gray-500">This action cannot be undone.</p>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 rounded-b-2xl flex gap-3">
                <button onclick="closeModals()"
                    class="flex-1 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors shadow-sm">Cancel</button>
                <form id="deleteForm" method="POST" class="flex-1 m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors shadow-sm">Delete</button>
                </form>
            </div>
        </div>

    </div>

    <div id="logoutModal" class="fixed inset-0 z-[200] hidden print:hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeLogoutModal()"></div>
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
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Ready to leave?</h3>
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
                                class="inline-flex w-full justify-center rounded-lg bg-[#5A8265] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#4A6B53] sm:ml-3 sm:w-auto transition-colors">Yes,
                                Log Out</button>
                        </form>
                        <button type="button" onclick="closeLogoutModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTab = 'All';

        // Filters (Tabs + Search + Select)
        function filterStatus(status) {
            currentTab = status;

            // Update Tab UI
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-[#5A8265]', 'text-[#5A8265]', 'border-b-2');
                btn.classList.add('border-transparent', 'text-gray-500');
                if (btn.dataset.tab === status) {
                    btn.classList.remove('border-transparent', 'text-gray-500');
                    btn.classList.add('active', 'border-[#5A8265]', 'text-[#5A8265]', 'border-b-2');
                }
            });

            applyFilters();
        }

        function applyFilters() {
            const searchInput = document.getElementById('search-input');
            const typeSelect = document.getElementById('type-select');

            const searchVal = searchInput ? searchInput.value.toLowerCase() : '';
            const typeVal = typeSelect ? typeSelect.value : 'All';
            const rows = document.querySelectorAll('.customer-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowType = row.getAttribute('data-type');
                const rowSearch = row.getAttribute('data-search');

                let show = true;

                // Tab Filter
                if (currentTab !== 'All' && rowStatus !== currentTab) show = false;
                // Type Filter
                if (typeVal !== 'All' && rowType !== typeVal) show = false;
                // Search Filter
                if (searchVal && !rowSearch.includes(searchVal)) show = false;

                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            const emptyState = document.getElementById('empty-state');
            if (emptyState) {
                emptyState.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
            }
        }

        // DRAWER LOGIC
        const drawerBackdrop = document.getElementById('drawer-backdrop');
        const customerDrawer = document.getElementById('customer-drawer');

        function openDrawer(customer) {
            // Populate Drawer Data (Added safety checks)
            if (document.getElementById('drawer-name')) document.getElementById('drawer-name').textContent = customer.name;
            if (document.getElementById('drawer-email')) document.getElementById('drawer-email').textContent = customer
                .email || 'No email provided';
            if (document.getElementById('drawer-phone')) document.getElementById('drawer-phone').textContent = customer
                .phone || 'N/A';
            if (document.getElementById('drawer-avatar')) document.getElementById('drawer-avatar').textContent = customer
                .name.substring(0, 1);

            // Format Currency
            const formatCash = (val) => new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(val);
            if (document.getElementById('drawer-balance')) document.getElementById('drawer-balance').textContent =
                formatCash(customer.balance);
            if (document.getElementById('drawer-limit')) document.getElementById('drawer-limit').textContent = formatCash(
                customer.credit_limit);

            // Update Drawer Badges
            const typeBadge = document.getElementById('drawer-type-badge');
            if (typeBadge) {
                typeBadge.textContent = customer.type;
                typeBadge.className = customer.type === 'Wholesale' ?
                    'text-xs font-bold uppercase tracking-wider text-purple-600' :
                    'text-xs font-bold uppercase tracking-wider text-blue-600';
            }

            const statusBadge = document.getElementById('drawer-status-badge');
            if (statusBadge) {
                statusBadge.textContent = customer.status;
                statusBadge.className = customer.status === 'Active' ?
                    'text-xs font-bold uppercase tracking-wider text-[#5A8265]' :
                    'text-xs font-bold uppercase tracking-wider text-gray-400';
            }

            // Bind Action Buttons inside drawer (THIS IS THE MAIN FIX)
            const drawerEditBtn = document.getElementById('drawer-edit-btn');
            if (drawerEditBtn) {
                drawerEditBtn.onclick = () => {
                    closeDrawer();
                    setTimeout(() => openEditModal(customer), 300);
                };
            }

            const drawerDeleteBtn = document.getElementById('drawer-delete-btn');
            if (drawerDeleteBtn) {
                drawerDeleteBtn.onclick = () => {
                    closeDrawer();
                    setTimeout(() => openDeleteModal(customer.id), 300);
                };
            }

            // Show Drawer
            if (drawerBackdrop && customerDrawer) {
                drawerBackdrop.classList.remove('hidden');
                drawerBackdrop.classList.add('block');
                setTimeout(() => {
                    drawerBackdrop.classList.remove('opacity-0');
                    drawerBackdrop.classList.add('opacity-100');
                    customerDrawer.classList.remove('translate-x-full');
                }, 10);
            }
        }

        function closeDrawer() {
            if (customerDrawer && drawerBackdrop) {
                customerDrawer.classList.add('translate-x-full');
                drawerBackdrop.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => {
                    drawerBackdrop.classList.add('hidden');
                    drawerBackdrop.classList.remove('block');
                }, 300);
            }
        }

        // MODALS LOGIC
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modals = document.querySelectorAll('.customer-modal');

        function openModal(modalId) {
            modals.forEach(m => m.classList.replace('flex', 'hidden'));
            const modal = document.getElementById(modalId);

            if (modalBackdrop && modal) {
                modalBackdrop.classList.remove('hidden');
                modalBackdrop.classList.add('flex');

                setTimeout(() => {
                    modalBackdrop.classList.remove('opacity-0');
                    modalBackdrop.classList.add('opacity-100');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    setTimeout(() => {
                        modal.classList.replace('scale-95', 'scale-100');
                    }, 10);
                }, 10);
            }
        }

        function closeModals() {
            if (modalBackdrop) {
                modals.forEach(modal => {
                    modal.classList.replace('scale-100', 'scale-95');
                });
                modalBackdrop.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => {
                    modalBackdrop.classList.add('hidden');
                    modalBackdrop.classList.remove('flex');
                    modals.forEach(m => {
                        m.classList.add('hidden');
                        m.classList.remove('flex');
                    });
                }, 300);
            }
        }

        function openEditModal(customer) {
            if (document.getElementById('editForm')) document.getElementById('editForm').action =
                `/customers/${customer.id}`;
            if (document.getElementById('edit_name')) document.getElementById('edit_name').value = customer.name;
            if (document.getElementById('edit_phone')) document.getElementById('edit_phone').value = customer.phone || '';
            if (document.getElementById('edit_email')) document.getElementById('edit_email').value = customer.email || '';
            if (document.getElementById('edit_type')) document.getElementById('edit_type').value = customer.type;
            if (document.getElementById('edit_status')) document.getElementById('edit_status').value = customer.status;
            if (document.getElementById('edit_balance')) document.getElementById('edit_balance').value = customer.balance;
            if (document.getElementById('edit_credit_limit')) document.getElementById('edit_credit_limit').value = customer
                .credit_limit;
            openModal('modal-edit-customer');
        }

        function openDeleteModal(id) {
            if (document.getElementById('deleteForm')) document.getElementById('deleteForm').action = `/customers/${id}`;
            openModal('modal-delete-customer');
        }

        function openLogoutModal() {
            const logoutModal = document.getElementById('logoutModal');
            if (logoutModal) logoutModal.classList.remove('hidden');
        }

        function closeLogoutModal() {
            const logoutModal = document.getElementById('logoutModal');
            if (logoutModal) logoutModal.classList.add('hidden');
        }

        // Listeners for backdrops
        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', (e) => {
                if (e.target === modalBackdrop) closeModals();
            });
        }

        // Initial setup
        applyFilters();
    </script>
</body>

</html>
