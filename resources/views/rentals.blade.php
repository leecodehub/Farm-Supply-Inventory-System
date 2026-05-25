<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Assets - Farmtastic</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        .hide-arrows::-webkit-outer-spin-button, .hide-arrows::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .hide-arrows { -moz-appearance: textfield; }
    </style>
</head>
<body class="bg-[#F4F7F6] h-screen flex font-sans text-gray-800 overflow-hidden relative selection:bg-[#5A8265] selection:text-white">

    <aside class="hidden md:flex w-[80px] hover:w-[260px] bg-[#2C4A3E] text-white flex-col h-full flex-shrink-0 z-20 transition-all duration-300 group overflow-hidden absolute md:relative shadow-xl print:hidden">
    
    <div class="p-6 border-b border-white/10 flex items-center gap-3 whitespace-nowrap">
        <img src="{{ asset('images/logo.png') }}" alt="Farmtastic Logo" class="w-10 h-10 object-contain flex-shrink-0 drop-shadow-sm">
        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <h1 class="font-bold text-lg leading-tight tracking-wide">Farmtastic</h1>
            <p class="text-[11px] text-[#A6BBAA] font-medium tracking-wide">Farm Supply</p>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 overflow-x-hidden custom-scrollbar">
        
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('dashboard*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('dashboard*') ? 'opacity-90' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Dashboard</span>
            </a>
        @endif

        <a href="/inventory" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('inventory*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('inventory*') ? 'opacity-90' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Stock Overview</span>
        </a>
        
        <a href="/pos" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('pos*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('pos*') ? 'opacity-90' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sales (POS)</span>
        </a>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="/purchases" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('purchasing*', 'purchases*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('purchasing*', 'purchases*') ? 'opacity-90' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Purchasing & Orders</span>
            </a>
        @endif

        <a href="/customers" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('customers*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('customers*') ? 'opacity-90' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Customers</span>
        </a>
        
        <a href="/rentals" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors whitespace-nowrap {{ Request::is('rentals*') ? 'bg-[#5A8265] text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ Request::is('rentals*') ? 'opacity-90' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
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

    <main class="flex-1 flex flex-col min-w-0 bg-[#F4F7F6] pl-[80px] md:pl-0 transition-all duration-300 overflow-hidden">
        
        <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between flex-shrink-0">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Rental Assets</h2>
        <p class="text-sm text-gray-500 mt-1">Manage farm equipment rentals, availability, and scheduling.</p>
    </div>
    <div class="flex items-center gap-3">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <button onclick="openModal('modal-add-asset')" class="px-4 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-all shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Asset
            </button>
        @endif
    </div>
</header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">

            @if(session('success'))
                <div class="mb-6 p-4 bg-[#E8F0EA] border border-[#5A8265]/30 text-[#5A8265] rounded-xl font-bold flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-[#5A8265] hover:text-gray-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl font-medium shadow-sm">
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Total Assets</p>
        </div>
        <div class="mt-3 flex justify-end">
            <h3 class="text-2xl font-black text-gray-800">{{ $rentals->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-full bg-[#E8F0EA] flex items-center justify-center text-[#5A8265] flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Available</p>
        </div>
        <div class="mt-3 flex justify-end">
            <h3 class="text-2xl font-black text-[#5A8265]">{{ $rentals->where('status', 'Available')->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-full bg-[#EFF6FF] flex items-center justify-center text-[#3B82F6] flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Currently Rented</p>
        </div>
        <div class="mt-3 flex justify-end">
            <h3 class="text-2xl font-black text-[#3B82F6]">{{ $rentals->where('status', 'Rented')->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-full bg-[#FEE2E2] flex items-center justify-center text-[#DC2626] flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
            </div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-1">Maintenance</p>
        </div>
        <div class="mt-3 flex justify-end">
            <h3 class="text-2xl font-black text-gray-800">{{ $rentals->where('status', 'Maintenance')->count() }}</h3>
        </div>
    </div>

</div>

            <form method="GET" action="/rentals" id="filter-form" class="w-full mb-6">
    
    <input type="hidden" name="status" id="status_filter" value="{{ request('status', 'all') }}">

    <div class="flex flex-col md:flex-row items-end justify-between gap-4">
        
        <div class="flex space-x-2 overflow-x-auto w-full md:w-auto p-1 bg-gray-200/50 rounded-xl" id="rental-tabs">
            <button type="button" onclick="document.getElementById('status_filter').value='all'; document.getElementById('filter-form').submit();" 
                class="tab-btn {{ request('status', 'all') == 'all' ? 'bg-white text-[#5A8265] shadow-sm font-bold' : 'text-gray-500 hover:text-gray-700 font-medium' }} px-5 py-2.5 text-sm rounded-lg transition-all">
                All Assets
            </button>
            <button type="button" onclick="document.getElementById('status_filter').value='available'; document.getElementById('filter-form').submit();" 
                class="tab-btn {{ request('status') == 'available' ? 'bg-white text-[#5A8265] shadow-sm font-bold' : 'text-gray-500 hover:text-gray-700 font-medium' }} px-5 py-2.5 text-sm rounded-lg transition-all">
                Available
            </button>
            <button type="button" onclick="document.getElementById('status_filter').value='rented'; document.getElementById('filter-form').submit();" 
                class="tab-btn {{ request('status') == 'rented' ? 'bg-white text-[#5A8265] shadow-sm font-bold' : 'text-gray-500 hover:text-gray-700 font-medium' }} px-5 py-2.5 text-sm rounded-lg transition-all">
                Rented
            </button>
            <button type="button" onclick="document.getElementById('status_filter').value='maintenance'; document.getElementById('filter-form').submit();" 
                class="tab-btn {{ request('status') == 'maintenance' ? 'bg-white text-[#5A8265] shadow-sm font-bold' : 'text-gray-500 hover:text-gray-700 font-medium' }} px-5 py-2.5 text-sm rounded-lg transition-all">
                Maintenance
            </button>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
            
            <div class="relative flex-1 md:w-64 w-full">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search asset or SN... (Press Enter)" class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] focus:border-[#5A8265] shadow-sm">
            </div>
            
            <select name="category" onchange="this.form.submit()" class="py-2 pl-3 pr-8 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-[#5A8265] text-gray-600 appearance-none shadow-sm w-full md:w-auto">
                <option value="All" {{ request('category') == 'All' ? 'selected' : '' }}>All Categories</option>
                <option value="Heavy Machinery" {{ request('category') == 'Heavy Machinery' ? 'selected' : '' }}>Heavy Machinery</option>
                <option value="Hand Tools" {{ request('category') == 'Hand Tools' ? 'selected' : '' }}>Hand Tools</option>
                <option value="Power Tools" {{ request('category') == 'Power Tools' ? 'selected' : '' }}>Power Tools</option>
                <option value="Harvesting" {{ request('category') == 'Harvesting' ? 'selected' : '' }}>Harvesting</option>
                <option value="Others" {{ request('category') == 'Others' ? 'selected' : '' }}>Others</option>
            </select>

            @if(request('search') || (request('category') && request('category') != 'All') || (request('status') && request('status') != 'all'))
                <a href="/rentals" class="text-xs text-red-500 font-bold hover:underline whitespace-nowrap ml-2">Clear Filters</a>
            @endif
        </div>
        
    </div>
</form>

            <div id="assets-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($rentals as $rental)
        <div class="asset-card bg-white border border-gray-200 rounded-2xl p-5 hover:border-[#5A8265] hover:shadow-md transition-all group flex flex-col h-full relative" 
             data-category="{{ $rental->category }}" 
             data-status="{{ strtolower($rental->status) }}" 
             data-search="{{ strtolower($rental->name . ' ' . $rental->sn) }}">
            
            @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="absolute top-2 right-2 flex gap-2 z-20">
                <button onclick="openEditModal({{ $rental }})" class="bg-blue-600 text-white p-2 rounded-lg shadow hover:bg-blue-700 transition" title="Edit Asset">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>

                <button type="button" onclick="openDeleteModal({{ $rental }})" class="bg-red-500 text-white p-2 rounded-lg shadow hover:bg-red-600 transition" title="Delete Asset">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
            @endif
            
            <div class="h-32 bg-gray-100 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden">
                @if($rental->image)
                    <img src="{{ asset('storage/' . $rental->image) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-400 font-medium">No Image</span>
                @endif
                
                @if($rental->status == 'Available')
                    <div class="absolute top-3 right-3 bg-[#E8F0EA] text-[#5A8265] text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded shadow-sm">Available</div>
                @elseif($rental->status == 'Rented')
                    <div class="absolute top-3 right-3 bg-[#EFF6FF] text-[#3B82F6] text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded shadow-sm">Rented</div>
                @else
                    <div class="absolute top-3 right-3 bg-[#FEE2E2] text-[#DC2626] text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded shadow-sm">{{ $rental->status }}</div>
                @endif
            </div>

            <div class="flex-1">
                <h3 class="font-bold text-gray-800 text-base leading-tight mb-1 group-hover:text-[#5A8265] transition-colors">{{ $rental->name }}</h3>
                <p class="text-xs text-gray-500 font-mono mb-3">SN: {{ $rental->sn }}</p>
                <p class="text-sm font-medium text-gray-600 mb-4">{{ $rental->category }}</p>
            </div>

            <div class="mt-auto border-t border-gray-100 pt-4">
                <div class="flex items-end justify-between mb-4">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Daily Rate</span>
                    <span class="font-black text-gray-800 text-lg">₱{{ number_format($rental->daily_rate, 2) }}</span>
                </div>
                <div class="flex gap-2">
                    @if($rental->status == 'Available')
                        <button onclick='openBookModal(@json($rental))' class="flex-1 bg-[#5A8265] hover:bg-[#4A6B53] text-white py-2.5 rounded-xl text-sm font-bold shadow-sm transition-colors">Book Now</button>
                    @elseif($rental->status == 'Rented')
                        <button onclick='openReturnModal(@json($rental))' class="flex-1 bg-[#EFF6FF] hover:bg-blue-100 text-[#3B82F6] border border-blue-200 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-colors">Return</button>
                    @else
                        <button class="flex-1 bg-gray-100 text-gray-400 cursor-not-allowed py-2.5 rounded-xl text-sm font-bold">Fixing</button>
                    @endif
                    
                    @php $activeTrans = $rental->transactions->where('status', 'Active')->first(); @endphp
                    <button onclick='openAssetDrawer(@json($rental), @json($activeTrans ? $activeTrans->customer : null), @json($activeTrans ? $activeTrans->expected_return_date : null))' class="px-4 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-xl text-sm font-bold transition-colors">Details</button>
                </div>
            </div>
        </div>
    @empty
        <div id="empty-state" class="col-span-full py-20 text-center text-gray-400 font-medium bg-white rounded-2xl border border-gray-200">No equipment found. Add an asset to get started!</div>
    @endforelse
</div> 
<div class="mt-8">
    {{ $rentals->links() }}
        </div>
    </main>

    <div id="modal-backdrop" class="fixed inset-0 bg-black/40 z-[100] hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"></div>
    <div id="drawer-backdrop" class="fixed inset-0 bg-black/20 z-[120] hidden opacity-0 transition-opacity duration-300"></div>

    <div id="modal-book-asset" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-2xl shadow-2xl z-[110] hidden scale-95 opacity-0 transition-all duration-300 overflow-hidden flex-col max-h-[90vh]">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between flex-shrink-0">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Book Equipment</h3>
                <p class="text-sm text-[#5A8265] font-bold mt-1" id="book-asset-name"></p>
            </div>
            <button type="button" onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition-colors bg-gray-50 hover:bg-gray-100 p-2 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        
        <form id="book-form" method="POST" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            <div class="p-6 overflow-y-auto custom-scrollbar flex-1 space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Select Customer <span class="text-red-500">*</span></label>
                    <select name="customer_id" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-white">
                        <option value="" disabled selected>Choose a customer...</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Expected Return Date <span class="text-red-500">*</span></label>
                    <input type="date" name="expected_return_date" required min="{{ date('Y-m-d') }}" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm bg-white">
                </div>

                <div id="booking-cost-preview" class="p-4 bg-green-50 border border-green-200 rounded-lg hidden">
                    <p class="text-xs text-green-600 font-bold uppercase mb-1">Estimated Cost Preview</p>
                    <p class="text-sm text-gray-800">
                        <span id="book-days" class="font-bold">0</span> Days × ₱<span id="book-rate">0</span> = 
                        <strong class="text-xl text-[#5A8265] ml-2" id="book-total">₱0.00</strong>
                    </p>
                </div>
                </div>
            <div class="px-8 py-5 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50/50">
                <button type="button" onclick="closeModals()" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 rounded-xl">Cancel</button>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl shadow-md">Confirm Booking</button>
            </div>
        </form>
    </div>

    <div id="modal-return-asset" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl shadow-2xl z-[110] hidden scale-95 opacity-0 transition-all duration-300 overflow-hidden flex-col max-h-[90vh]">
    <form id="return-form" method="POST" class="p-6">
        @csrf
        
        <div class="mb-4 text-center">
            <h3 class="text-xl font-black text-gray-800 uppercase tracking-wide">Process Return</h3>
            <p class="text-sm text-gray-500 mt-1">You are about to return <span id="return-asset-name" class="font-bold text-[#5A8265]"></span>.</p>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-4 text-sm shadow-inner">
            <div class="flex justify-between mb-1"><span class="text-gray-500">Start Date:</span> <span id="ret-start" class="font-semibold text-gray-700"></span></div>
            <div class="flex justify-between mb-1"><span class="text-gray-500">Expected Return:</span> <span id="ret-expected" class="font-semibold text-gray-700"></span></div>
            <div class="flex justify-between mb-1"><span class="text-gray-500">Actual Return:</span> <span class="font-bold text-blue-600">Today</span></div>
            <div class="flex justify-between mb-1"><span class="text-gray-500">Total Days Borrowed:</span> <span id="ret-days" class="font-semibold text-gray-700"></span></div>
            <div class="flex justify-between mb-2"><span class="text-gray-500">Daily Rate:</span> <span id="ret-rate" class="font-semibold text-gray-700"></span></div>
            
            <div class="border-t border-gray-200 my-2 pt-2 flex justify-between items-center">
                <span class="text-gray-800 font-bold">Base Cost:</span> 
                <span class="font-black text-[#5A8265] text-base" id="ret-base-cost"></span>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Damage / Penalty Fee (₱)</label>
            <input type="number" id="damage-input" name="damage_fee" step="0.01" min="0" value="0.00" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-lg font-bold text-red-600 focus:ring-[#5A8265] focus:border-[#5A8265] outline-none transition-all">
        </div>

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Return Notes</label>
            <textarea name="return_notes" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#5A8265] focus:border-[#5A8265] outline-none transition-all" placeholder="Any damage details?"></textarea>
        </div>

        <div class="mb-6 text-center bg-gray-800 rounded-xl py-3 shadow-md">
            <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Final Total to Pay</p>
            <p class="text-2xl font-black text-white" id="ret-final-total">₱0.00</p>
        </div>

        <div class="flex gap-3">
            <button type="button" onclick="closeModals()" class="w-1/2 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Cancel</button>
            <button type="submit" class="w-1/2 py-2.5 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-md">Complete</button>
        </div>
    </form>
</div>

    <div id="modal-add-asset" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl bg-white rounded-2xl shadow-2xl z-[110] hidden scale-95 opacity-0 transition-all duration-300 overflow-hidden flex-col max-h-[90vh]">
        <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between flex-shrink-0">
            <div>
                <h3 class="text-xl font-extrabold text-gray-800">Add Rental Asset</h3>
                <p class="text-sm text-gray-500 mt-1">Register new equipment into the rental pool.</p>
            </div>
            <button type="button" onclick="closeModals()" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        
        <form action="{{ route('rentals.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            <div class="flex-1 overflow-y-auto p-8 custom-scrollbar space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Equipment Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Asset SN/Code <span class="text-red-500">*</span></label>
                        <input type="text" name="sn" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Category</label>
                        <select name="category" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-1 focus:ring-[#5A8265]">
                            <option value="Heavy Machinery">Heavy Machinery</option>
                            <option value="Hand Tools">Hand Tools</option>
                            <option value="Power Tools">Power Tools</option>
                            <option value="Harvesting">Harvesting</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Daily Rental Rate (₱) <span class="text-red-500">*</span></label>
                        <input type="number" name="daily_rate" step="0.01" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm hide-arrows">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Asset Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#E8F0EA] file:text-[#5A8265]">
                </div>
            </div>
            <div class="px-8 py-5 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50/50">
                <button type="button" onclick="closeModals()" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 rounded-xl">Cancel</button>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl shadow-md">Save Asset</button>
            </div>
        </form>
    </div>

    <div id="modal-edit-asset" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-2xl shadow-2xl z-[110] hidden scale-95 opacity-0 transition-all duration-300 overflow-hidden flex-col max-h-[90vh]">
        <form id="edit-asset-form" method="POST" enctype="multipart/form-data" class="flex flex-col h-full">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50 flex-shrink-0">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-wide">Edit Rental Asset</h3>
                <button type="button" onclick="closeModals()" class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar flex-grow space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Asset Name <span class="text-red-500">*</span></label>
                        <input type="text" id="edit-name" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#5A8265] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Serial Number <span class="text-red-500">*</span></label>
                        <input type="text" id="edit-sn" name="sn" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#5A8265] outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Category <span class="text-red-500">*</span></label>
                        <select id="edit-category" name="category" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#5A8265] outline-none focus:ring-1">
                            <option value="Heavy Machinery">Heavy Machinery</option>
                            <option value="Hand Tools">Hand Tools</option>
                            <option value="Power Tools">Power Tools</option>
                            <option value="Harvesting">Harvesting</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Daily Rate (₱) <span class="text-red-500">*</span></label>
                        <input type="number" id="edit-rate" name="daily_rate" step="0.01" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#5A8265] outline-none hide-arrows">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Status <span class="text-red-500">*</span></label>
                    <select id="edit-status" name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#5A8265] outline-none">
                        <option value="Available">Available</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Replace Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600">
                    <p class="text-[10px] text-gray-500 mt-1">Leave blank to keep the current image.</p>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 flex gap-3 flex-shrink-0 bg-gray-50">
                <button type="button" onclick="closeModals()" class="w-1/2 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl transition-colors">Cancel</button>
                <button type="submit" class="w-1/2 py-2.5 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-md">Update Asset</button>
            </div>
        </form>
    </div>
    <div id="modal-delete-asset" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl z-[110] hidden scale-95 opacity-0 transition-all duration-300 overflow-hidden flex-col">
        <div class="px-6 py-8 flex items-center justify-center flex-col text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-500 mb-4 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-gray-800">Delete Asset?</h3>
            <p class="text-sm text-gray-500 mt-2">Are you sure you want to completely delete <span id="delete-asset-name" class="font-extrabold text-gray-800"></span>? This action cannot be undone.</p>
        </div>
        
        <div class="p-4 border-t border-gray-100 flex gap-3 bg-gray-50">
            <button type="button" onclick="closeModals()" class="w-1/2 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl transition-colors">Cancel</button>
            <form id="delete-asset-form" method="POST" class="w-1/2 m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-2.5 text-sm font-bold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-colors shadow-md">Yes, Delete</button>
            </form>
        </div>
    </div>
    <div id="drawer-asset" class="fixed top-0 right-0 h-full w-[450px] max-w-[90vw] bg-white shadow-2xl z-[130] translate-x-full transition-transform duration-300 flex flex-col border-l border-gray-200">
        <div class="h-48 bg-gray-100 relative flex-shrink-0">
            <button onclick="closeDrawer()" class="absolute top-4 right-4 text-gray-500 bg-white/80 hover:bg-white rounded-full p-2 transition-colors shadow-sm backdrop-blur-sm z-10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div id="drawer-image-container" class="w-full h-full"></div>
        </div>

        <div class="p-6 overflow-y-auto flex-1 bg-white">
            <div class="mb-6">
                <h3 class="text-2xl font-extrabold text-gray-800 leading-tight" id="drawer-asset-name"></h3>
                <p class="text-sm font-bold text-gray-400 mt-1"><span id="drawer-asset-sn"></span> &bull; <span id="drawer-asset-cat"></span></p>
            </div>
            <div id="drawer-status-badge"></div>
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Daily Rate</p>
                    <p class="text-xl font-black text-[#5A8265]" id="drawer-asset-rate"></p>
                </div>
            </div>

            <div id="drawer-renter-box" class="hidden border border-[#3B82F6]/30 bg-[#EFF6FF] rounded-xl p-5 mb-8">
                <h4 class="text-sm font-bold text-[#1D4ED8] mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Currently Rented Out
                </h4>
                <div class="space-y-2 text-sm text-blue-900">
                    <div class="flex justify-between font-bold"><span>Renter:</span> <span id="drawer-renter-name"></span></div>
                    <div class="flex justify-between"><span>Phone:</span> <span id="drawer-renter-phone"></span></div>
                    <div class="flex justify-between border-t border-blue-200 pt-2 mt-2"><span>Due Back:</span> <span class="font-bold" id="drawer-renter-due"></span></div>
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-100 bg-gray-50 flex gap-3 flex-shrink-0">
            <button id="drawer-action-btn" class="flex-1 py-3.5 text-sm font-bold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-colors shadow-md">Book Asset</button>
        </div>
    </div>

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
        // --- GLOBAL VARIABLES FOR LIVE MATH ---
        let currentDailyRate = 0;
        let currentBaseCost = 0;

        // FILTERS LOGIC (Updated to work with Blade DOM Elements)
        let currentTab = 'all';

        function applyFilters() {
            const searchVal = document.getElementById('search-input').value.toLowerCase();
            const categoryVal = document.getElementById('category-select').value;
            const cards = document.querySelectorAll('.asset-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                const category = card.getAttribute('data-category');
                const search = card.getAttribute('data-search');

                let show = true;
                if (currentTab !== 'all' && status !== currentTab) show = false;
                if (categoryVal !== 'All' && category !== categoryVal) show = false;
                if (searchVal && !search.includes(searchVal)) show = false;

                card.style.display = show ? '' : 'none';
                if(show) visibleCount++;
            });

            const emptyState = document.getElementById('empty-state');
            if(emptyState) {
                if(visibleCount === 0 && cards.length > 0) {
                    emptyState.style.display = 'block';
                    emptyState.textContent = 'No equipment found matching your filters.';
                } else {
                    emptyState.style.display = 'none';
                }
            }
        }

        function setTab(tabName) {
            currentTab = tabName;
            document.querySelectorAll('.tab-btn').forEach(tab => {
                tab.classList.remove('bg-white', 'text-[#5A8265]', 'shadow-sm');
                tab.classList.add('text-gray-500');
            });
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.remove('text-gray-500');
            activeTab.classList.add('bg-white', 'text-[#5A8265]', 'shadow-sm');
            applyFilters();
        }

        // MODALS LOGIC
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalBook = document.getElementById('modal-book-asset');
        const modalAdd = document.getElementById('modal-add-asset');
        const modalReturn = document.getElementById('modal-return-asset');
        const modalEdit = document.getElementById('modal-edit-asset'); 
        const modalDelete = document.getElementById('modal-delete-asset'); // <-- ADDED DELETE MODAL

        function openModal(modalId) {
            document.querySelectorAll('.hidden.bg-white.rounded-2xl').forEach(m => {
                if(m.id !== 'logoutModal' && m.id !== 'drawer-asset') {
                    m.classList.replace('flex', 'hidden');
                    m.classList.replace('scale-100', 'scale-95');
                    m.classList.add('opacity-0');
                }
            });

            const modal = document.getElementById(modalId);
            modalBackdrop.classList.remove('hidden');
            modalBackdrop.classList.add('flex');
            
            setTimeout(() => {
                modalBackdrop.classList.remove('opacity-0');
                modalBackdrop.classList.add('opacity-100');
                modal.classList.remove('hidden');
                modal.classList.add('flex'); 
                setTimeout(() => { 
                    modal.classList.replace('scale-95', 'scale-100'); 
                    modal.classList.remove('opacity-0');
                }, 10);
            }, 10);
        }

        function openBookModal(rental) {
            document.getElementById('book-form').action = `/rentals/${rental.id}/book`;
            document.getElementById('book-asset-name').textContent = `${rental.name} (${rental.sn})`;
            
            // --- Prepare the live booking calculator ---
            currentDailyRate = parseFloat(rental.daily_rate);
            const expectedDateInput = document.querySelector('input[name="expected_return_date"]');
            const costPreviewBox = document.getElementById('booking-cost-preview');
            
            if(expectedDateInput) expectedDateInput.value = ''; // Reset date
            if(costPreviewBox) costPreviewBox.classList.add('hidden'); // Hide preview until date picked

            openModal('modal-book-asset');
        }

        function openReturnModal(rental) {
            document.getElementById('return-form').action = `/rentals/${rental.id}/return`;
            document.getElementById('return-asset-name').textContent = rental.name;
            
            // --- Live Calculator Math for Return ---
            const transaction = rental.transactions && rental.transactions.length > 0 
                                ? rental.transactions.find(t => t.status === 'Active') 
                                : null;

            if (transaction) {
                // Calculate exact days
                const start = new Date(transaction.start_date);
                start.setHours(0,0,0,0);
                const today = new Date();
                today.setHours(0,0,0,0);
                
                let days = Math.round((today - start) / (1000 * 60 * 60 * 24));
                if (days < 1) days = 1; // Minimum 1 day charge

                // Math!
                let rate = parseFloat(rental.daily_rate);
                currentBaseCost = days * rate;

                // Update UI text
                const elStart = document.getElementById('ret-start');
                if (elStart) {
                    elStart.textContent = transaction.start_date;
                    document.getElementById('ret-expected').textContent = transaction.expected_return_date;
                    document.getElementById('ret-days').textContent = days + " Day(s)";
                    document.getElementById('ret-rate').textContent = '₱' + rate.toLocaleString('en-US', {minimumFractionDigits: 2});
                    document.getElementById('ret-base-cost').textContent = '₱' + currentBaseCost.toLocaleString('en-US', {minimumFractionDigits: 2});
                    
                    // Reset Damage Input and Total
                    document.getElementById('damage-input').value = '0.00';
                    const finalTotalText = document.getElementById('ret-final-total');
                    if(finalTotalText) finalTotalText.textContent = '₱' + currentBaseCost.toLocaleString('en-US', {minimumFractionDigits: 2});
                }
            }

            openModal('modal-return-asset');
        }

        function openEditModal(asset) {
            // Auto-fill the inputs with the asset's current data
            document.getElementById('edit-name').value = asset.name;
            document.getElementById('edit-sn').value = asset.sn;
            document.getElementById('edit-category').value = asset.category;
            // Force pure decimal format so the number input accepts it perfectly
            document.getElementById('edit-rate').value = parseFloat(asset.daily_rate).toFixed(2);
            document.getElementById('edit-status').value = asset.status;

            // Point the form to the correct backend URL
            document.getElementById('edit-asset-form').action = `/rentals/${asset.id}`;

            openModal('modal-edit-asset');
        }

        // --- NEW: DELETE MODAL FUNCTION ---
        function openDeleteModal(asset) {
            document.getElementById('delete-asset-name').textContent = asset.name;
            document.getElementById('delete-asset-form').action = `/rentals/${asset.id}`;
            openModal('modal-delete-asset');
        }
        // ----------------------------------

        function closeModals() {
            // Included modalEdit and modalDelete in the close array
            [modalAdd, modalBook, modalReturn, modalEdit, modalDelete].forEach(modal => {
                if(modal && !modal.classList.contains('hidden')){
                    modal.classList.replace('scale-100', 'scale-95');
                    modal.classList.add('opacity-0');
                }
            });
            modalBackdrop.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => {
                modalBackdrop.classList.add('hidden');
                modalBackdrop.classList.remove('flex');
                [modalAdd, modalBook, modalReturn, modalEdit, modalDelete].forEach(modal => {
                    if(modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                });
            }, 300);
        }

        // DRAWER LOGIC
        const drawerBackdrop = document.getElementById('drawer-backdrop');
        const drawerAsset = document.getElementById('drawer-asset');

        function openAssetDrawer(rental, customer, returnDate) {
            document.getElementById('drawer-asset-name').textContent = rental.name;
            document.getElementById('drawer-asset-sn').textContent = rental.sn;
            document.getElementById('drawer-asset-cat').textContent = rental.category;
            document.getElementById('drawer-asset-rate').textContent = `₱${parseFloat(rental.daily_rate).toLocaleString('en-US', {minimumFractionDigits: 2})}`;

            // Handle Image
            const imgContainer = document.getElementById('drawer-image-container');
            if (rental.image) {
                imgContainer.innerHTML = `<img src="/storage/${rental.image}" class="w-full h-full object-cover">`;
            } else {
                imgContainer.innerHTML = `<div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>`;
            }

            // Handle Status Badge
            let badgeHtml = '';
            if(rental.status === 'Available') badgeHtml = `<span class="px-2 py-1 bg-[#E8F0EA] text-[#5A8265] text-xs font-bold uppercase tracking-wider rounded mb-6 inline-block">Available</span>`;
            if(rental.status === 'Rented') badgeHtml = `<span class="px-2 py-1 bg-[#EFF6FF] text-[#3B82F6] text-xs font-bold uppercase tracking-wider rounded mb-6 inline-block">Rented Out</span>`;
            if(rental.status === 'Maintenance') badgeHtml = `<span class="px-2 py-1 bg-[#FEE2E2] text-[#DC2626] text-xs font-bold uppercase tracking-wider rounded mb-6 inline-block">Maintenance</span>`;
            document.getElementById('drawer-status-badge').innerHTML = badgeHtml;

            // Handle Renter Tracking Box
            const renterBox = document.getElementById('drawer-renter-box');
            if(rental.status === 'Rented' && customer) {
                renterBox.classList.remove('hidden');
                document.getElementById('drawer-renter-name').textContent = customer.name;
                document.getElementById('drawer-renter-phone').textContent = customer.phone;
                document.getElementById('drawer-renter-due').textContent = new Date(returnDate).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            } else {
                renterBox.classList.add('hidden');
            }

            // --- ACTION BUTTON LOGIC START ---
            const isAdmin = {{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }};
            const actionBtn = document.getElementById('drawer-action-btn');
            
            document.querySelectorAll('.dynamic-drawer-action').forEach(el => el.remove());
            actionBtn.style.display = 'block';

            if(rental.status === 'Rented' && customer) {
                actionBtn.textContent = 'Process Return';
                actionBtn.className = "w-full py-3.5 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-md";
                actionBtn.onclick = () => { closeDrawer(); setTimeout(() => openReturnModal(rental), 300); };
            
            } else if(rental.status === 'Available') {
                actionBtn.textContent = 'Book Asset';
                actionBtn.className = "w-full mb-3 py-3.5 text-sm font-bold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-colors shadow-md";
                actionBtn.onclick = () => { closeDrawer(); setTimeout(() => openBookModal(rental), 300); };
                
                if (isAdmin) {
                    actionBtn.insertAdjacentHTML('afterend', `
                        <form action="/rentals/${rental.id}/maintenance" method="POST" class="m-0 dynamic-drawer-action">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full py-3.5 text-sm font-bold text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 rounded-xl shadow-sm transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                Put Under Maintenance
                            </button>
                        </form>
                    `);
                }

            } else {
                actionBtn.style.display = 'none';
                if (isAdmin) {
                    actionBtn.insertAdjacentHTML('afterend', `
                        <form action="/rentals/${rental.id}/maintenance" method="POST" class="m-0 dynamic-drawer-action">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full py-3.5 text-sm font-bold text-white bg-blue-500 hover:bg-blue-600 rounded-xl shadow-md transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Mark as Available
                            </button>
                        </form>
                    `);
                } else {
                    actionBtn.insertAdjacentHTML('afterend', `
                        <button disabled class="w-full py-3.5 text-sm font-bold text-white bg-gray-400 cursor-not-allowed rounded-xl shadow-md flex items-center justify-center gap-2 dynamic-drawer-action">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            In Maintenance 
                        </button>
                    `);
                }
            }
            // --- ACTION BUTTON LOGIC END ---

            drawerBackdrop.classList.remove('hidden');
            drawerBackdrop.classList.add('block');
            setTimeout(() => {
                drawerBackdrop.classList.remove('opacity-0');
                drawerBackdrop.classList.add('opacity-100');
                drawerAsset.classList.remove('translate-x-full');
            }, 10);
        }

        function closeDrawer() {
            drawerAsset.classList.add('translate-x-full');
            drawerBackdrop.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => {
                drawerBackdrop.classList.add('hidden');
                drawerBackdrop.classList.remove('block');
            }, 300);
        }

        // Logout
        function openLogoutModal() { document.getElementById('logoutModal').classList.remove('hidden'); }
        function closeLogoutModal() { document.getElementById('logoutModal').classList.add('hidden'); }

        // Closers
        modalBackdrop.addEventListener('click', (e) => { if (e.target === modalBackdrop) closeModals(); });
        drawerBackdrop.addEventListener('click', (e) => { if (e.target === drawerBackdrop) closeDrawer(); });

        // --- LIVE CALCULATOR EVENT LISTENERS ---
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Live Booking Estimator
            const expectedDateInput = document.querySelector('input[name="expected_return_date"]');
            const costPreviewBox = document.getElementById('booking-cost-preview');

            if(expectedDateInput) {
                expectedDateInput.addEventListener('change', function() {
                    if(!this.value || currentDailyRate === 0) {
                        costPreviewBox.classList.add('hidden');
                        return;
                    }

                    const start = new Date();
                    start.setHours(0,0,0,0);
                    const end = new Date(this.value);
                    end.setHours(0,0,0,0);
                    
                    let days = Math.round((end - start) / (1000 * 60 * 60 * 24));
                    if (days < 1) days = 1;

                    const totalCost = days * currentDailyRate;

                    document.getElementById('book-days').textContent = days;
                    document.getElementById('book-rate').textContent = currentDailyRate.toLocaleString('en-US', {minimumFractionDigits: 2});
                    document.getElementById('book-total').textContent = '₱' + totalCost.toLocaleString('en-US', {minimumFractionDigits: 2});
                    
                    costPreviewBox.classList.remove('hidden');
                });
            }

            // 2. Live Return Modal Math (Damage Fee Additions)
            const damageInput = document.getElementById('damage-input');
            const finalTotalText = document.getElementById('ret-final-total');

            if(damageInput) {
                damageInput.addEventListener('input', function() {
                    let damageFee = parseFloat(this.value) || 0;
                    let finalTotal = currentBaseCost + damageFee;
                    if(finalTotalText) {
                        finalTotalText.textContent = '₱' + finalTotal.toLocaleString('en-US', {minimumFractionDigits: 2});
                    }
                });
            }
        });
        // --------------------------------------------
</script>
</body>
</html>