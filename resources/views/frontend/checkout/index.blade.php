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

                        <!-- Payment Method Radio Choices -->
                        <div class="space-y-3">
                            <!-- Option 1: Cash on Delivery -->
                            <label id="label_cod" class="flex items-start p-4 rounded-xl border-2 {{ old('payment_method', 'Cash on Delivery') === 'Cash on Delivery' ? 'border-matcha-700 bg-matcha-50/40 ring-1 ring-matcha-700' : 'border-stone-200 bg-white hover:bg-stone-50' }} cursor-pointer transition-all">
                                <input type="radio" name="payment_method" value="Cash on Delivery" {{ old('payment_method', 'Cash on Delivery') === 'Cash on Delivery' ? 'checked' : '' }} onchange="togglePaymentMethod('cod')" class="mt-1 text-matcha-800 focus:ring-matcha-600">
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="block text-sm font-bold text-stone-900">Cash on Delivery (COD)</span>
                                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-amber-100 text-amber-800">Cash</span>
                                    </div>
                                    <span class="block text-xs text-stone-500 mt-0.5">Pay directly in cash to the courier rider upon delivery of your order.</span>
                                </div>
                            </label>

                            <!-- Option 2: E-Payment (QRPh) -->
                            <label id="label_epayment" class="flex items-start p-4 rounded-xl border-2 {{ old('payment_method') === 'E-Payment' ? 'border-matcha-700 bg-matcha-50/40 ring-1 ring-matcha-700' : 'border-stone-200 bg-white hover:bg-stone-50' }} cursor-pointer transition-all">
                                <input type="radio" name="payment_method" value="E-Payment" {{ old('payment_method') === 'E-Payment' ? 'checked' : '' }} onchange="togglePaymentMethod('epayment')" class="mt-1 text-matcha-800 focus:ring-matcha-600">
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="block text-sm font-bold text-stone-900">E-Payment (QRPh Scan)</span>
                                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">Instant Verification</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-[11px] font-bold text-stone-600">
                                            <span>GCash • Maya • Grab • Banks</span>
                                        </div>
                                    </div>
                                    <span class="block text-xs text-stone-500 mt-0.5">Scan QRPh via GCash, Maya, GrabPay, or any Mobile Banking App.</span>
                                </div>
                            </label>
                        </div>

                        <!-- E-Payment QRPh Container (Visible when E-Payment is selected) -->
                        <div id="epayment_container" class="{{ old('payment_method') === 'E-Payment' ? 'block' : 'hidden' }} mt-4 pt-4 border-t border-stone-200 space-y-4">
                            <div class="bg-gradient-to-br from-matcha-50/60 to-emerald-50/40 p-5 sm:p-6 rounded-2xl border border-matcha-200 space-y-5">
                                
                                <div class="flex flex-col sm:flex-row items-center gap-6">
                                    <!-- QR Code Display Frame -->
                                    <div class="flex-shrink-0 bg-white p-3 rounded-2xl border border-stone-200 shadow-md text-center max-w-[220px]">
                                        <div class="rounded-xl overflow-hidden border border-stone-100 bg-stone-50">
                                            <img src="{{ asset('uploads/payments/qrph.jpg') }}" alt="QRPh Payment Code - Task Kyoto Consultancy" class="w-full h-auto object-contain hover:scale-105 transition-transform duration-300 cursor-pointer" onclick="window.open(this.src, '_blank')">
                                        </div>
                                        <p class="text-[10px] text-stone-500 font-medium mt-2">
                                            <i data-lucide="zoom-in" class="w-3 h-3 inline text-matcha-700"></i> Click image to enlarge / save
                                        </p>
                                    </div>

                                    <!-- QR & Merchant Info -->
                                    <div class="space-y-3 flex-1 text-xs">
                                        <div class="bg-white/80 backdrop-blur-sm p-3.5 rounded-xl border border-matcha-200/80 space-y-1">
                                            <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Official Merchant / Account</div>
                                            <div class="text-sm font-bold text-matcha-950 font-serif">Task Kyoto Consultancy Opc - Taguig</div>
                                            <div class="text-[11px] text-stone-600 flex items-center gap-1.5 pt-1">
                                                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                                                <span>QRPh Accepted (All major PH e-wallets & banks)</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between bg-matcha-900 text-white p-3.5 rounded-xl">
                                            <span class="text-xs uppercase tracking-wider font-semibold text-cream-200">Amount to Send:</span>
                                            <span class="text-base font-serif font-bold text-gold-400">₱{{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step-by-Step Instructions -->
                                <div class="bg-white rounded-xl p-4 sm:p-5 border border-stone-200 space-y-3 text-xs">
                                    <h4 class="font-bold text-stone-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5">
                                        <i data-lucide="info" class="w-4 h-4 text-matcha-700"></i>
                                        <span>Payment Steps & Proof Verification</span>
                                    </h4>

                                    <ol class="space-y-2.5 text-stone-700 list-decimal list-inside pl-1 text-[11.5px] leading-relaxed">
                                        <li><strong>Scan the QRPh code</strong> using GCash, Maya, GrabPay, ShopeePay, or any bank app.</li>
                                        <li>Input the exact total amount: <strong class="text-matcha-900">₱{{ number_format($total, 2) }}</strong>.</li>
                                        <li><strong>Copy the Reference / Transaction Number</strong> from your payment receipt and enter it in the box below.</li>
                                        <li>
                                            <strong>Take a screenshot of the payment receipt</strong> and send it to our Official Facebook Page for quick verification:
                                            <div class="mt-2">
                                                <a href="https://web.facebook.com/coffeebasephilippines" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#1877F2] hover:bg-[#166fe5] text-white rounded-lg text-xs font-bold shadow-sm transition-all">
                                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                                    <span>Send Proof to Facebook: Coffee Base Philippines</span>
                                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ol>
                                </div>

                                <!-- Payment Reference Input -->
                                <div class="space-y-1.5">
                                    <label for="checkout_payment_reference" class="block text-xs font-bold uppercase tracking-wider text-matcha-950">
                                        Payment Reference Number / Transaction ID *
                                    </label>
                                    <input type="text" id="checkout_payment_reference" name="payment_reference" value="{{ old('payment_reference') }}" placeholder="e.g. 100492819283 / 20261002-XXXX" class="w-full px-4 py-3 rounded-xl border border-matcha-300 text-sm font-mono font-bold focus:ring-2 focus:ring-matcha-600 outline-none bg-white text-stone-900 placeholder:font-sans placeholder:font-normal">
                                    <p class="text-[11px] text-stone-500">
                                        Please enter the reference number shown on your GCash/Bank receipt. Admin will verify this against your Facebook message screenshot.
                                    </p>
                                    @error('payment_reference')
                                        <p class="text-xs text-rose-600 font-bold mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
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
                            @php
                                $hasDiscount = !empty($item['discount_percent']) && $item['discount_percent'] > 0;
                            @endphp
                            <div class="flex items-center justify-between pt-3 first:pt-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-lg bg-cream-100 overflow-hidden flex-shrink-0 border border-stone-200">
                                        <img src="{{ $item['image'] ?? '/uploads/products/samidori.jpg' }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-stone-900 leading-tight">{{ $item['name'] }}</p>
                                        <p class="text-[11px] font-mono text-matcha-800">{{ $item['weight'] }} × {{ $item['quantity'] }}</p>
                                        @if($hasDiscount)
                                            <span class="inline-block bg-emerald-50 text-emerald-800 text-[9px] font-mono font-bold px-1.5 py-0.2 rounded border border-emerald-200">
                                                {{ $item['discount_percent'] }}% Bulk Tier Applied
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-sans font-bold text-stone-900 block font-mono">
                                        ₱{{ number_format($item['line_total'], 2) }}
                                    </span>
                                    @if($hasDiscount && $item['line_savings'] > 0)
                                        <span class="text-[9.5px] text-emerald-700 font-mono block">Saved ₱{{ number_format($item['line_savings'], 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2.5 pt-4 border-t border-stone-100 text-xs">
                        @if(isset($totalSavings) && $totalSavings > 0)
                            <div class="flex justify-between text-stone-600">
                                <span>Original Subtotal</span>
                                <span class="font-mono">₱{{ number_format($originalSubtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-emerald-700 font-bold bg-emerald-50 p-2 rounded-lg border border-emerald-200">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                    <span>Bulk Volume Discount</span>
                                </span>
                                <span class="font-mono">-₱{{ number_format($totalSavings, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between text-lg font-sans font-bold text-matcha-950 pt-1">
                            <span>Total Amount</span>
                            <span class="font-mono">₱{{ number_format($total, 2) }}</span>
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

    <script>
        function togglePaymentMethod(method) {
            const epaymentContainer = document.getElementById('epayment_container');
            const refInput = document.getElementById('checkout_payment_reference');
            const labelCod = document.getElementById('label_cod');
            const labelEpayment = document.getElementById('label_epayment');

            if (method === 'epayment') {
                epaymentContainer.classList.remove('hidden');
                refInput.setAttribute('required', 'required');
                
                labelEpayment.className = 'flex items-start p-4 rounded-xl border-2 border-matcha-700 bg-matcha-50/40 ring-1 ring-matcha-700 cursor-pointer transition-all';
                labelCod.className = 'flex items-start p-4 rounded-xl border-2 border-stone-200 bg-white hover:bg-stone-50 cursor-pointer transition-all';
            } else {
                epaymentContainer.classList.add('hidden');
                refInput.removeAttribute('required');
                
                labelCod.className = 'flex items-start p-4 rounded-xl border-2 border-matcha-700 bg-matcha-50/40 ring-1 ring-matcha-700 cursor-pointer transition-all';
                labelEpayment.className = 'flex items-start p-4 rounded-xl border-2 border-stone-200 bg-white hover:bg-stone-50 cursor-pointer transition-all';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const epaymentRadio = document.querySelector('input[name="payment_method"][value="E-Payment"]');
            if (epaymentRadio && epaymentRadio.checked) {
                togglePaymentMethod('epayment');
            }
        });
    </script>

@endsection
