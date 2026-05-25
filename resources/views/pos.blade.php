<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmtastic POS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <main id="main-content" class="flex-1 flex min-w-0 bg-[#F4F7F6] pl-[80px] md:pl-0 transition-all duration-300">
        <section class="flex-1 flex flex-col h-full border-r border-gray-200">
            <div class="bg-white p-5 border-b border-gray-200 flex-shrink-0">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Point of Sale</h2>
                    <span class="text-sm font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Cashier:
                        {{ auth()->user()->name ?? 'Staff' }}</span>
                </div>

                <div class="relative w-full">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" id="search-input" oninput="handleSearch(this.value)"
                        placeholder="Search product by name or SKU..."
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#5A8265]/20 focus:border-[#5A8265] transition-all font-medium text-gray-700 placeholder-gray-400 shadow-sm">
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-5 custom-scrollbar">
                <div id="product-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                </div>
            </div>
        </section>

        <aside
            class="w-[380px] bg-white flex flex-col h-full flex-shrink-0 shadow-[-4px_0_15px_-3px_rgba(0,0,0,0.05)] z-10">
            <div
                class="p-5 border-b border-[#1A3027] flex items-center justify-between bg-[#2C4A3E] text-white flex-shrink-0">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#A6BBAA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Current Sale
                </h3>
                <button onclick="clearCart()"
                    class="text-xs text-[#FCA5A5] font-semibold hover:text-white transition-colors flex items-center gap-1 bg-white/10 px-2.5 py-1 rounded-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Clear
                </button>
            </div>

            <div id="cart-items" class="flex-1 overflow-y-auto p-5 space-y-4 bg-gray-50/30 custom-scrollbar">
            </div>

            <div class="p-5 border-t border-gray-200 bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.02)] flex-shrink-0">
                <div class="space-y-2.5 mb-5">
                    <div class="flex justify-between text-sm text-gray-500 font-medium">
                        <span>Subtotal</span>
                        <span id="display-subtotal" class="text-gray-800">₱0.00</span>
                    </div>
                    <div
                        class="flex justify-between text-sm text-gray-500 font-medium pb-2.5 border-b border-gray-100">
                        <span>Tax (5%)</span>
                        <span id="display-tax" class="text-gray-800">₱0.00</span>
                    </div>
                    <div class="flex justify-between items-end pt-1">
                        <span class="text-gray-800 font-bold">Total</span>
                        <span id="display-total"
                            class="text-3xl font-extrabold text-[#5A8265] tracking-tight">₱0.00</span>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Payment
                        Method</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button id="btn-cash" onclick="openModal('cash')"
                            class="payment-btn py-2.5 border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded-xl text-sm font-medium flex flex-col items-center justify-center gap-1 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Cash
                        </button>
                        <button id="btn-card" onclick="openModal('card')"
                            class="payment-btn py-2.5 border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded-xl text-sm font-medium flex flex-col items-center justify-center gap-1 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Card
                        </button>
                        <button id="btn-gcash" onclick="openModal('gcash')"
                            class="payment-btn py-2.5 border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded-xl text-sm font-medium flex flex-col items-center justify-center gap-1 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            GCash
                        </button>
                    </div>
                </div>

                <button id="main-complete-sale-btn" onclick="finishTransaction()"
                    class="w-full bg-gray-200 text-gray-400 py-3.5 rounded-xl font-bold text-base transition-all flex items-center justify-center gap-2 cursor-not-allowed opacity-70"
                    disabled>
                    Complete Sale
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </div>
        </aside>
    </main>

    <div id="payment-modal-container"
        class="hidden absolute inset-0 w-full h-full flex items-center justify-center z-50 transition-all duration-300">
        <div onclick="closeModal()" class="absolute inset-0 bg-black/40"></div>

        <div id="modal-content"
            class="relative bg-white rounded-3xl shadow-2xl transition-transform duration-300 scale-95 opacity-0 w-[640px] max-w-full overflow-hidden">

            <div id="modal-cash" class="hidden grid grid-cols-[1fr_260px] gap-8 p-8">
                <div>
                    <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                        <div class="p-3 rounded-xl bg-[#E8F0EA] text-[#5A8265]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">Cash Calculator</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Tap amounts to add up the cash tendered.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <button onclick="quickCash('exact')"
                            class="col-span-2 text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 py-3 rounded-xl border border-gray-200 transition-colors">Exact</button>
                        <button onclick="quickCash('clear')"
                            class="text-sm font-bold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 py-3 rounded-xl transition-colors shadow-sm">Clear</button>

                        <button onclick="quickCash(20)"
                            class="text-sm font-bold text-[#5A8265] bg-[#E8F0EA] hover:bg-[#D9E6DB] py-3 rounded-xl border border-[#5A8265]/20 transition-colors">+
                            ₱20</button>
                        <button onclick="quickCash(50)"
                            class="text-sm font-bold text-[#5A8265] bg-[#E8F0EA] hover:bg-[#D9E6DB] py-3 rounded-xl border border-[#5A8265]/20 transition-colors">+
                            ₱50</button>
                        <button onclick="quickCash(100)"
                            class="text-sm font-bold text-[#5A8265] bg-[#E8F0EA] hover:bg-[#D9E6DB] py-3 rounded-xl border border-[#5A8265]/20 transition-colors">+
                            ₱100</button>
                        <button onclick="quickCash(200)"
                            class="text-sm font-bold text-[#5A8265] bg-[#E8F0EA] hover:bg-[#D9E6DB] py-3 rounded-xl border border-[#5A8265]/20 transition-colors">+
                            ₱200</button>
                        <button onclick="quickCash(500)"
                            class="text-sm font-bold text-[#5A8265] bg-[#E8F0EA] hover:bg-[#D9E6DB] py-3 rounded-xl border border-[#5A8265]/20 transition-colors">+
                            ₱500</button>
                        <button onclick="quickCash(1000)"
                            class="text-sm font-bold text-[#5A8265] bg-[#E8F0EA] hover:bg-[#D9E6DB] py-3 rounded-xl border border-[#5A8265]/20 transition-colors">+
                            ₱1000</button>
                    </div>

                    <div class="flex items-center gap-2 pt-2 border-t border-gray-100">
                        <button onclick="closeModal()"
                            class="flex-1 py-3 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 rounded-xl transition-colors shadow-sm">Cancel</button>
                        <button id="proceed-cash-btn" onclick="confirmPayment('cash')"
                            class="flex-1 py-3 text-sm font-semibold text-white bg-gray-300 rounded-xl transition-colors shadow-sm cursor-not-allowed"
                            disabled>Proceed</button>
                    </div>
                </div>

                <div class="space-y-4 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <div class="flex justify-between items-end border-b border-gray-100 pb-3 mb-3">
                        <span class="text-gray-500 font-bold text-sm">Total</span>
                        <span id="modal-cash-total"
                            class="text-2xl font-extrabold text-[#5A8265] tracking-tight">₱0.00</span>
                    </div>

                    <div
                        class="bg-white rounded-xl p-3 border border-gray-200 relative focus-within:border-[#5A8265] focus-within:ring-1 focus-within:ring-[#5A8265] transition-all">
                        <label class="block text-[10px] text-gray-500 uppercase font-bold mb-0.5 tracking-wider">Amount
                            Tendered</label>
                        <div class="relative flex items-center">
                            <span class="text-gray-500 font-bold mr-1">₱</span>
                            <input type="number" id="cash-tendered" value=""
                                class="w-full bg-transparent text-gray-800 font-bold text-lg focus:outline-none p-0 border-0"
                                placeholder="0.00" oninput="validateCashPayment()">
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-3 border border-gray-200 flex flex-col justify-center">
                        <label
                            class="block text-[10px] text-gray-500 uppercase font-bold mb-0.5 tracking-wider">Change</label>
                        <div id="cash-change" class="text-gray-800 font-bold text-lg leading-tight">₱0.00</div>
                    </div>
                </div>
            </div>

            <div id="modal-card" class="hidden flex flex-col items-center gap-6 p-10 pt-12">
                <div class="p-4 rounded-xl bg-[#E8F0EA] text-[#5A8265]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                </div>
                <h4 class="text-2xl font-extrabold text-gray-800">Card Payment</h4>
                <p class="text-base text-gray-500 text-center max-w-[320px] leading-relaxed">Please swipe or insert
                    card into the card reader to continue payment for <strong id="modal-card-total">₱0.00</strong>.</p>

                <div class="flex items-center gap-3 pt-6 border-t border-gray-100 w-full">
                    <button onclick="closeModal()"
                        class="flex-1 py-3 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 rounded-xl transition-colors shadow-sm">Cancel</button>
                    <button onclick="confirmPayment('card')"
                        class="flex-1 py-3 text-sm font-semibold text-white bg-[#5A8265] hover:bg-[#4A6B53] rounded-xl transition-colors shadow-md">Proceed</button>
                </div>
            </div>

            <div id="modal-gcash" class="hidden flex flex-col items-center gap-6 p-10 pt-12">
                <div class="p-4 rounded-xl bg-[#E8F0EA] text-[#5A8265]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h4 class="text-2xl font-extrabold text-gray-800">GCash QR Code</h4>
                <p class="text-base text-gray-500 text-center leading-relaxed">Scan the QR code with your GCash app to
                    pay <strong id="modal-gcash-total">₱0.00</strong>.</p>

                <div class="w-full">
                    <input type="text" id="gcash-ref" placeholder="Enter GCash Reference Number"
                        oninput="validateGcashPayment()"
                        class="w-full text-sm border border-gray-200 bg-white rounded-lg py-2.5 px-3 focus:outline-none focus:ring-1 focus:ring-[#5A8265] focus:border-[#5A8265] transition-all text-center placeholder-gray-400 font-medium">
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-gray-100 w-full">
                    <button onclick="closeModal()"
                        class="flex-1 py-3 text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-100 rounded-xl transition-colors shadow-sm">Cancel</button>
                    <button id="proceed-gcash-btn" onclick="confirmPayment('gcash')"
                        class="flex-1 py-3 text-sm font-semibold text-white bg-gray-300 rounded-xl transition-colors shadow-sm cursor-not-allowed"
                        disabled>Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div id="receipt-modal-container"
        class="hidden absolute inset-0 w-full h-full flex items-center justify-center z-[60] bg-black/60 transition-all duration-300 backdrop-blur-sm">
        <div
            class="bg-white w-[340px] max-w-full rounded-b-lg shadow-2xl relative flex flex-col font-mono text-sm border-t-8 border-[#2C4A3E]">
            <div class="p-6 pb-8">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800 uppercase tracking-widest">Farmtastic</h2>
                    <p class="text-xs text-gray-500">Farm Supply Store</p>
                    <p class="text-xs text-gray-500">Davao City, Philippines</p>
                    <p class="text-xs text-gray-500 mt-2" id="receipt-date"></p>
                </div>

                <div class="border-b border-dashed border-gray-300 pb-3 mb-3">
                    <div class="flex justify-between text-xs mb-1">
                        <span>Cashier: {{ auth()->user()->name ?? 'Staff' }}</span>
                        <span>POS-1</span>
                    </div>
                </div>

                <div id="receipt-items" class="space-y-3 border-b border-dashed border-gray-300 pb-4 mb-4">
                </div>

                <div id="receipt-totals" class="space-y-1 border-b border-dashed border-gray-300 pb-4 mb-4">
                </div>

                <div id="receipt-payment-details" class="space-y-1 text-xs">
                </div>

                <div class="text-center mt-8 text-xs text-gray-500">
                    <p>Thank you for shopping with us!</p>
                    <p>Please come again.</p>
                </div>
            </div>

            <button onclick="closeReceipt()"
                class="w-full bg-[#E8F0EA] text-[#2C4A3E] font-bold py-4 hover:bg-[#D9E6DB] transition-colors rounded-b-lg text-sm border-t border-gray-200">
                Close & Next Transaction
            </button>
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
        const productsDatabase = @json($products ?? []);

        let cart = [];
        let currentMethod = null;
        let confirmedMethod = null;
        let totals = {
            subtotal: 0,
            tax: 0,
            total: 0
        };

        function renderProducts(filterText = '') {
            const grid = document.getElementById('product-grid');
            grid.innerHTML = '';

            const filtered = productsDatabase.filter(p =>
                (p.name && p.name.toLowerCase().includes(filterText.toLowerCase())) ||
                (p.sku && p.sku.toLowerCase().includes(filterText.toLowerCase()))
            );

            if (filtered.length === 0) {
                grid.innerHTML = `<div class="col-span-full text-center text-gray-400 py-10">No products found.</div>`;
                return;
            }

            filtered.forEach(product => {
                const isOutOfStock = product.stock <= 0;
                const sellingPrice = parseFloat(product.price || 0);

                const imageHtml = product.image ?
                    `<img src="/storage/products/${product.image}" class="w-full h-full object-cover rounded-lg">` :
                    `<span class="text-gray-400 font-bold text-xs">No Image</span>`;

                const card = document.createElement('div');
                if (isOutOfStock) {
                    card.className =
                        "bg-white border border-gray-200 rounded-xl p-3 cursor-not-allowed opacity-60 flex flex-col h-full relative";
                    card.innerHTML = `
                        <div class="h-28 bg-gray-100 rounded-lg mb-3 flex items-center justify-center relative overflow-hidden">
                            ${imageHtml}
                            <div class="absolute top-2 right-2 bg-[#D97768] text-[#FFFFFF] text-xs font-bold px-2 py-0.5 rounded shadow-sm">Out of stock</div>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm leading-tight mb-1 flex-1">${product.name}</h3>
                        <p class="text-xs text-gray-400 mb-3">SKU: ${product.sku}</p>
                        <div class="flex items-center justify-between mt-auto border-t border-gray-100 pt-3">
                            <div class="font-extrabold text-[#5A8265] text-lg">₱${sellingPrice.toFixed(2)}</div>
                            <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </div>
                    `;
                } else {
                    card.className =
                        "bg-white border border-gray-200 rounded-xl p-3 cursor-pointer hover:border-[#5A8265] hover:shadow-md transition-all group flex flex-col h-full relative";
                    card.onclick = () => addToCart(product.id);
                    card.innerHTML = `
                        <div class="h-28 bg-gray-100 rounded-lg mb-3 flex items-center justify-center relative overflow-hidden">
                            ${imageHtml}
                            <div class="absolute top-2 right-2 bg-white/90 text-xs font-bold px-2 py-0.5 rounded shadow-sm text-gray-700">${product.stock} in stock</div>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-[#5A8265] transition-colors line-clamp-2 mb-1 flex-1">${product.name}</h3>
                        <p class="text-xs text-gray-400 mb-3">SKU: ${product.sku}</p>
                        <div class="flex items-center justify-between mt-auto border-t border-gray-100 pt-3">
                            <div class="font-extrabold text-[#5A8265] text-lg">₱${sellingPrice.toFixed(2)}</div>
                            <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center group-hover:bg-[#5A8265] group-hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </div>
                    `;
                }
                grid.appendChild(card);
            });
        }

        function handleSearch(val) {
            renderProducts(val);
        }

        function addToCart(productId) {
            const product = productsDatabase.find(p => p.id === productId);
            if (!product || product.stock <= 0) return;

            const existingItem = cart.find(item => item.product.id === productId);
            if (existingItem) {
                if (existingItem.qty < product.stock) {
                    existingItem.qty += 1;
                } else {
                    alert('Cannot exceed available stock!');
                }
            } else {
                cart.push({
                    product: product,
                    qty: 1
                });
            }
            updateCart();
        }

        function changeQty(productId, newQtyStr) {
            let newQty = parseInt(newQtyStr);
            if (isNaN(newQty) || newQty <= 0) return;

            const item = cart.find(i => i.product.id === productId);
            if (item) {
                if (newQty > item.product.stock) {
                    alert('Cannot exceed available stock!');
                    item.qty = item.product.stock;
                } else {
                    item.qty = newQty;
                }
                updateCart();
            }
        }

        function increaseQty(productId) {
            const item = cart.find(i => i.product.id === productId);
            if (item && item.qty < item.product.stock) {
                item.qty += 1;
                updateCart();
            } else if (item) {
                alert('Cannot exceed available stock!');
            }
        }

        function decreaseQty(productId) {
            const item = cart.find(i => i.product.id === productId);
            if (item) {
                item.qty -= 1;
                if (item.qty <= 0) {
                    removeItem(productId);
                } else {
                    updateCart();
                }
            }
        }

        function removeItem(productId) {
            cart = cart.filter(i => i.product.id !== productId);
            updateCart();
        }

        function clearCart() {
            cart = [];
            updateCart();
        }

        function updateCart() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';

            totals.subtotal = cart.reduce((sum, item) => sum + (parseFloat(item.product.price) * item.qty), 0);
            totals.tax = totals.subtotal * 0.05;
            totals.total = totals.subtotal + totals.tax;

            document.getElementById('display-subtotal').textContent = `₱${totals.subtotal.toFixed(2)}`;
            document.getElementById('display-tax').textContent = `₱${totals.tax.toFixed(2)}`;
            document.getElementById('display-total').textContent = `₱${totals.total.toFixed(2)}`;

            if (cart.length === 0) {
                cartContainer.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="text-sm">Cart is empty</p>
                    </div>`;
            } else {
                cart.forEach(item => {
                    const price = parseFloat(item.product.price);
                    const itemTotal = price * item.qty;

                    const thumbnailHtml = item.product.image ?
                        `<img src="/storage/products/${item.product.image}" class="w-full h-full object-cover rounded-lg">` :
                        `<span class="text-gray-300 text-[10px] font-bold">IMG</span>`;

                    const el = document.createElement('div');
                    el.className =
                        "flex gap-3 group relative bg-white p-2 rounded-xl border border-gray-100 shadow-sm";
                    el.innerHTML = `
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex-shrink-0 border border-gray-200 flex items-center justify-center">
                            ${thumbnailHtml}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h4 class="font-bold text-sm text-gray-800 pr-4 leading-tight truncate">${item.product.name}</h4>
                                <button onclick="removeItem(${item.product.id})" class="text-gray-300 hover:text-[#D97768] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <div class="text-xs text-gray-400 mt-0.5">₱${price.toFixed(2)}</div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white">
                                    <button onclick="decreaseQty(${item.product.id})" class="px-2.5 py-1 text-gray-500 hover:bg-gray-100 transition-colors">-</button>
                                    <input type="number" onchange="changeQty(${item.product.id}, this.value)" value="${item.qty}" min="1" max="${item.product.stock}" class="w-10 text-center text-xs font-bold border-x border-gray-200 py-1 focus:outline-none hide-arrows">
                                    <button onclick="increaseQty(${item.product.id})" class="px-2.5 py-1 text-gray-500 hover:bg-gray-100 transition-colors">+</button>
                                </div>
                                <div class="font-bold text-gray-800">₱${itemTotal.toFixed(2)}</div>
                            </div>
                        </div>
                    `;
                    cartContainer.appendChild(el);
                });
            }

            lockCompleteBtn();
            resetPaymentButtons();
        }

        function openModal(method) {
            if (cart.length === 0) {
                alert("Please add items to the cart first.");
                return;
            }

            currentMethod = method;

            resetPaymentButtons();
            const selectedBtn = document.getElementById('btn-' + method);
            const selectedClasses =
                'payment-btn py-2.5 border-2 border-[#5A8265] bg-[#E8F0EA] text-[#5A8265] rounded-xl text-sm font-bold flex flex-col items-center justify-center gap-1 transition-all shadow-sm'
                .split(' ');
            selectedBtn.className = '';
            selectedBtn.classList.add(...selectedClasses);

            ['cash', 'card', 'gcash'].forEach(m => {
                document.getElementById('modal-' + m).classList.add('hidden');
                document.getElementById('modal-' + m).classList.remove(m === 'cash' ? 'grid' : 'flex');
            });

            if (method === 'cash') {
                document.getElementById('modal-cash').classList.remove('hidden');
                document.getElementById('modal-cash').classList.add('grid');
                document.getElementById('modal-cash-total').innerText = `₱${totals.total.toFixed(2)}`;
                quickCash('clear');
            } else if (method === 'card') {
                document.getElementById('modal-card').classList.remove('hidden');
                document.getElementById('modal-card').classList.add('flex');
                document.getElementById('modal-card-total').innerText = `₱${totals.total.toFixed(2)}`;
            } else if (method === 'gcash') {
                document.getElementById('modal-gcash').classList.remove('hidden');
                document.getElementById('modal-gcash').classList.add('flex');
                document.getElementById('modal-gcash-total').innerText = `₱${totals.total.toFixed(2)}`;
                document.getElementById('gcash-ref').value = '';
                validateGcashPayment();
            }

            document.getElementById('payment-modal-container').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('modal-content').classList.remove('scale-95', 'opacity-0');
            }, 50);
            document.getElementById('main-content').classList.add('blur-sm');
        }

        function closeModal() {
            document.getElementById('modal-content').classList.add('scale-95', 'opacity-0');
            document.getElementById('main-content').classList.remove('blur-sm');
            setTimeout(() => {
                document.getElementById('payment-modal-container').classList.add('hidden');
            }, 300);
        }

        function lockCompleteBtn() {
            const completeBtn = document.getElementById('main-complete-sale-btn');
            completeBtn.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed', 'opacity-70');
            completeBtn.classList.remove('bg-[#5A8265]', 'text-white', 'hover:bg-[#4A6B53]', 'shadow-lg', 'cursor-pointer');
            completeBtn.setAttribute('disabled', 'true');
            confirmedMethod = null;
        }

        function resetPaymentButtons() {
            const buttons = document.querySelectorAll('.payment-btn');
            const unselectedClasses =
                'payment-btn py-2.5 border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded-xl text-sm font-medium flex flex-col items-center justify-center gap-1 transition-all'
                .split(' ');
            buttons.forEach(btn => {
                btn.className = '';
                btn.classList.add(...unselectedClasses);
            });
        }

        function confirmPayment(method) {
            confirmedMethod = method;

            const completeBtn = document.getElementById('main-complete-sale-btn');
            completeBtn.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed', 'opacity-70');
            completeBtn.classList.add('bg-[#5A8265]', 'text-white', 'hover:bg-[#4A6B53]', 'shadow-lg', 'cursor-pointer');
            completeBtn.removeAttribute('disabled');

            closeModal();
        }

        function validateCashPayment() {
            const tenderedInput = document.getElementById('cash-tendered');
            const changeDisplay = document.getElementById('cash-change');
            const proceedBtn = document.getElementById('proceed-cash-btn');

            const tenderedAmount = parseFloat(tenderedInput.value) || 0;
            let change = tenderedAmount - totals.total;

            if (change < 0) {
                change = 0;
                proceedBtn.setAttribute('disabled', 'true');
                proceedBtn.classList.remove('bg-[#5A8265]', 'hover:bg-[#4A6B53]', 'shadow-md');
                proceedBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
            } else {
                proceedBtn.removeAttribute('disabled');
                proceedBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
                proceedBtn.classList.add('bg-[#5A8265]', 'hover:bg-[#4A6B53]', 'shadow-md');
            }

            changeDisplay.textContent = '₱' + change.toFixed(2);
        }

        function quickCash(amount) {
            const tenderedInput = document.getElementById('cash-tendered');

            if (amount === 'exact') {
                tenderedInput.value = totals.total.toFixed(2);
            } else if (amount === 'clear') {
                tenderedInput.value = '';
            } else {
                let currentVal = parseFloat(tenderedInput.value) || 0;
                tenderedInput.value = (currentVal + parseFloat(amount)).toFixed(2);
            }

            validateCashPayment();
        }

        function validateGcashPayment() {
            const refInput = document.getElementById('gcash-ref');
            const proceedBtn = document.getElementById('proceed-gcash-btn');

            if (refInput.value.trim().length > 5) {
                proceedBtn.removeAttribute('disabled');
                proceedBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
                proceedBtn.classList.add('bg-[#5A8265]', 'hover:bg-[#4A6B53]', 'shadow-md');
            } else {
                proceedBtn.setAttribute('disabled', 'true');
                proceedBtn.classList.remove('bg-[#5A8265]', 'hover:bg-[#4A6B53]', 'shadow-md');
                proceedBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
            }
        }

        // --- UPDATED CHECKOUT LOGIC WITH DATABASE CONNECTION ---
        async function finishTransaction() {
            // 1. Prepare cart data for the backend
            const cartData = cart.map(item => ({
                product_id: item.product.id,
                qty: item.qty
            }));

            // 2. Send the data to Laravel securely in the background
            try {
                const response = await fetch('/pos/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Required by Laravel for security
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        cart: cartData
                    })
                });

                const result = await response.json();

                if (result.success) {
                    // 3. IF DATABASE UPDATE WAS SUCCESSFUL: Build and show the receipt!
                    document.getElementById('receipt-date').innerText = new Date().toLocaleString();

                    const receiptItemsBox = document.getElementById('receipt-items');
                    receiptItemsBox.innerHTML = '';
                    cart.forEach(item => {
                        const price = parseFloat(item.product.price);
                        receiptItemsBox.innerHTML += `
                            <div class="flex justify-between items-start text-xs text-gray-800">
                                <div class="pr-2">
                                    <span class="block">${item.qty}x ${item.product.name}</span>
                                    <span class="text-gray-500">@ ₱${price.toFixed(2)}</span>
                                </div>
                                <span class="font-bold">₱${(item.qty * price).toFixed(2)}</span>
                            </div>
                        `;
                    });

                    document.getElementById('receipt-totals').innerHTML = `
                        <div class="flex justify-between text-xs"><span>Subtotal:</span><span>₱${totals.subtotal.toFixed(2)}</span></div>
                        <div class="flex justify-between text-xs"><span>Tax (5%):</span><span>₱${totals.tax.toFixed(2)}</span></div>
                        <div class="flex justify-between text-base font-bold mt-2"><span>TOTAL:</span><span>₱${totals.total.toFixed(2)}</span></div>
                    `;

                    const paymentDetailsBox = document.getElementById('receipt-payment-details');
                    if (confirmedMethod === 'cash') {
                        const tenderedAmount = parseFloat(document.getElementById('cash-tendered').value) || totals
                            .total;
                        const change = tenderedAmount - totals.total;
                        paymentDetailsBox.innerHTML = `
                            <div class="flex justify-between text-gray-600"><span>Method:</span><span class="font-bold">CASH</span></div>
                            <div class="flex justify-between"><span>Tendered:</span><span>₱${tenderedAmount.toFixed(2)}</span></div>
                            <div class="flex justify-between"><span>Change:</span><span>₱${change.toFixed(2)}</span></div>
                        `;
                    } else if (confirmedMethod === 'card') {
                        paymentDetailsBox.innerHTML = `
                            <div class="flex justify-between text-gray-600"><span>Method:</span><span class="font-bold">CARD</span></div>
                            <div class="flex justify-between"><span>Card Info:</span><span>VISA - **** 4242</span></div>
                            <div class="flex justify-between"><span>Auth Code:</span><span>8934A_OK</span></div>
                        `;
                    } else if (confirmedMethod === 'gcash') {
                        const refNum = document.getElementById('gcash-ref').value;
                        paymentDetailsBox.innerHTML = `
                            <div class="flex justify-between text-gray-600"><span>Method:</span><span class="font-bold text-[#205BEE]">GCASH</span></div>
                            <div class="flex justify-between"><span>Ref No:</span><span class="truncate pl-2">${refNum}</span></div>
                        `;
                    }

                    // Show the receipt modal
                    document.getElementById('receipt-modal-container').classList.remove('hidden');
                } else {
                    alert('Error completing sale: ' + result.message);
                }
            } catch (error) {
                console.error('Checkout error:', error);
                alert('Something went wrong communicating with the database. Please try again.');
            }
        }

        function closeReceipt() {
            // Hide the receipt
            document.getElementById('receipt-modal-container').classList.add('hidden');

            // Empty the cart
            clearCart();

            // RELOAD THE PAGE: This fetches the fresh, updated stock numbers from the database!
            window.location.reload();
        }

        // Logout Functions
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderProducts();
            updateCart();
        });
    </script>

    <style>
        .hide-arrows::-webkit-outer-spin-button,
        .hide-arrows::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .hide-arrows {
            -moz-appearance: textfield;
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
    </style>
</body>

</html>
