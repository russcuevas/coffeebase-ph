@extends('layouts.app')

@section('title', 'Secure Checkout | Coffee Base Philippines')

@section('content')

    <div class="bg-cream-100/70 border-b border-cream-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950">Express Checkout</h1>
            <p class="text-xs text-stone-500 uppercase tracking-widest mt-1">Direct Delivery Across the Philippines</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left: Shipping & Contact Details Form -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <!-- Customer Contact Info -->
                    <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                            <h2 class="text-base font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="user" class="w-4 h-4 text-gold-500"></i>
                                <span>1. Contact Information</span>
                            </h2>
                            @guest
                                <a href="{{ route('login') }}" class="text-xs text-matcha-800 hover:underline">Already have an account? Log in</a>
                            @endguest
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="checkout_first_name" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">First Name *</label>
                                <input type="text" id="checkout_first_name" name="first_name" required value="{{ old('first_name', $user->first_name ?? '') }}" placeholder="e.g. Juan" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>

                            <div>
                                <label for="checkout_last_name" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Last Name *</label>
                                <input type="text" id="checkout_last_name" name="last_name" required value="{{ old('last_name', $user->last_name ?? '') }}" placeholder="e.g. Dela Cruz" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="checkout_email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email Address *</label>
                                <input type="email" id="checkout_email" name="email" required value="{{ old('email', $user->email ?? '') }}" placeholder="juan@example.com" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>

                            <div>
                                <label for="checkout_phone" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Mobile Phone * (For Delivery Updates)</label>
                                <input type="tel" id="checkout_phone" name="phone" required value="{{ old('phone', $user->phone ?? '') }}" placeholder="0917 123 4567" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address (Philippines Required Fields) -->
                    <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                        <div class="pb-3 border-b border-stone-100">
                            <h2 class="text-base font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4 text-gold-500"></i>
                                <span>2. Delivery Address</span>
                            </h2>
                        </div>

                        <!-- Country (Automatic Philippines) -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Country / Region</label>
                            <input type="text" name="country" value="Philippines" readonly class="w-full px-4 py-2.5 rounded-lg border border-stone-200 bg-stone-100 text-stone-600 text-sm font-semibold cursor-not-allowed">
                        </div>

                        <!-- Company Optional -->
                        <div>
                            <label for="checkout_company" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Company / Cafe Name (Optional)</label>
                            <input type="text" id="checkout_company" name="company" value="{{ old('company', $user->company ?? '') }}" placeholder="e.g. Cafe Kyoto Manila" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <!-- Street Address -->
                        <div>
                            <label for="checkout_address" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Street Address / House No. / Building *</label>
                            <input type="text" id="checkout_address" name="address" required value="{{ old('address', $user->address ?? '') }}" placeholder="House #, Street name, Subdivision / Village" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <!-- Apartment Optional -->
                        <div>
                            <label for="checkout_apartment" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Apartment, suite, unit, floor (Optional)</label>
                            <input type="text" id="checkout_apartment" name="apartment" value="{{ old('apartment', $user->apartment ?? '') }}" placeholder="e.g. Unit 1204, Tower 2" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <!-- Barangay & City -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="checkout_barangay" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Barangay *</label>
                                <input type="text" id="checkout_barangay" name="barangay" required value="{{ old('barangay', $user->barangay ?? '') }}" placeholder="e.g. Barangay San Antonio" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>

                            <div>
                                <label for="checkout_city" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">City / Municipality *</label>
                                <input type="text" id="checkout_city" name="city" required value="{{ old('city', $user->city ?? '') }}" placeholder="e.g. Makati / Quezon City / Cebu" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                        </div>

                        <!-- Postal Code & Region -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="checkout_postal_code" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Postal Code (ZIP) *</label>
                                <input type="text" id="checkout_postal_code" name="postal_code" required value="{{ old('postal_code', $user->postal_code ?? '') }}" placeholder="e.g. 1203" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>

                            <div>
                                <label for="checkout_region" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Region / Province *</label>
                                <input type="text" id="checkout_region" name="region" required value="{{ old('region', $user->region ?? 'Metro Manila') }}" placeholder="e.g. Metro Manila / Cavite / Rizal" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                        </div>

                        <div>
                            <label for="checkout_notes" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Special Delivery Instructions / Gate Code (Optional)</label>
                            <textarea id="checkout_notes" name="customer_notes" rows="2" placeholder="e.g. Leave with building receptionist / Call when near" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('customer_notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                        <div class="pb-3 border-b border-stone-100">
                            <h2 class="text-base font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="credit-card" class="w-4 h-4 text-gold-500"></i>
                                <span>3. Payment Method</span>
                            </h2>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-start p-4 rounded-xl border-2 border-matcha-700 bg-matcha-50/40 cursor-pointer transition-all">
                                <input type="radio" name="payment_method" value="Cash on Delivery" checked class="mt-1 text-matcha-800 focus:ring-matcha-600">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-stone-900">Cash on Delivery (COD)</span>
                                    <span class="block text-xs text-stone-500">Pay directly in cash to the courier rider upon delivery of your order.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Right: Order Items & Place Order Summary -->
                <div class="lg:col-span-5 bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-6 sticky top-28">
                    <h3 class="text-lg font-sans font-bold tracking-tight text-stone-900 pb-3 border-b border-stone-100">
                        Items in Your Order ({{ count($cart) }})
                    </h3>

                    <div class="max-h-80 overflow-y-auto divide-y divide-stone-100 pr-1 space-y-3">
                        @foreach($cart as $item)
                            <div class="flex items-center justify-between pt-3 first:pt-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-lg bg-cream-100 overflow-hidden flex-shrink-0 border border-stone-200">
                                        <img src="{{ $item['image'] ?? '/uploads/products/samidori.jpg' }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-stone-900 leading-tight">{{ $item['name'] }}</p>
                                        <p class="text-[11px] font-mono text-matcha-800">{{ $item['weight'] }} × {{ $item['quantity'] }}</p>
                                    </div>
                                </div>
                                <span class="text-xs font-sans font-bold text-stone-900">
                                    ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2.5 pt-4 border-t border-stone-100 text-xs">
                        <div class="flex justify-between text-lg font-sans font-bold text-matcha-950">
                            <span>Total Amount</span>
                            <span>₱{{ number_format($total, 2) }}</span>
                        </div>
                        <p class="text-[11px] text-stone-500 bg-stone-50 p-2.5 rounded border border-stone-200 leading-relaxed">
                            <i data-lucide="truck" class="w-3.5 h-3.5 inline text-matcha-700 mr-1"></i>
                            <span>Courier delivery will be booked by admin upon confirmation with live tracking link.</span>
                        </p>
                    </div>

                    <button type="submit" class="w-full py-4 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-lg hover:shadow-xl transition-all">
                        Complete Order
                    </button>

                    <p class="text-[11px] text-stone-400 text-center leading-relaxed">
                        By placing this order, you will receive real-time updates and courier tracking upon admin dispatch.
                    </p>
                </div>

            </div>
        </form>
    </div>

@endsection
