@extends('layouts.app')

@section('title', "Order #{$order->order_number} | Coffee Base Philippines")

@section('content')

    <div class="bg-cream-100/70 border-b border-cream-300 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-mono font-bold text-matcha-700 uppercase tracking-widest">Order Confirmation & Live Status</span>
                <h1 class="text-2xl sm:text-3xl font-sans font-bold tracking-tight text-matcha-950 mt-0.5">Order #{{ $order->order_number }}</h1>
                <p class="text-xs text-stone-500 mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('orders.track') }}" class="px-4 py-2 rounded-lg bg-white border border-stone-300 text-stone-700 text-xs font-semibold uppercase tracking-wider hover:bg-stone-50">
                    Track Another Order
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        
        <!-- LIVE STATUS BANNER (CORE REQUIREMENT) -->
        <div class="rounded-2xl overflow-hidden border shadow-lg transition-all
            @if($order->status === 'pending') bg-amber-50/90 border-amber-200 text-amber-950
            @elseif($order->status === 'preparing') bg-blue-50/90 border-blue-200 text-blue-950
            @elseif($order->status === 'out_for_delivery') bg-purple-50/90 border-purple-200 text-purple-950
            @elseif($order->status === 'delivered') bg-emerald-50/90 border-emerald-200 text-emerald-950
            @else bg-stone-50 border-stone-200 text-stone-900 @endif">
            
            <div class="p-6 sm:p-8">
                
                <!-- Status Timeline Bar -->
                <div class="grid grid-cols-4 gap-2 mb-8">
                    <!-- Step 1: Pending -->
                    <div class="text-center">
                        <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs mb-1.5 shadow-sm
                            {{ in_array($order->status, ['pending', 'preparing', 'out_for_delivery', 'delivered']) ? 'bg-matcha-800 text-white' : 'bg-stone-200 text-stone-500' }}">
                            1
                        </div>
                        <span class="text-[10px] sm:text-xs uppercase font-bold tracking-wider block">Pending</span>
                    </div>

                    <!-- Step 2: Preparing -->
                    <div class="text-center">
                        <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs mb-1.5 shadow-sm
                            {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? 'bg-matcha-800 text-white' : 'bg-stone-200 text-stone-500' }}">
                            2
                        </div>
                        <span class="text-[10px] sm:text-xs uppercase font-bold tracking-wider block">Preparing</span>
                    </div>

                    <!-- Step 3: Out for Delivery -->
                    <div class="text-center">
                        <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs mb-1.5 shadow-sm
                            {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'bg-matcha-800 text-white' : 'bg-stone-200 text-stone-500' }}">
                            3
                        </div>
                        <span class="text-[10px] sm:text-xs uppercase font-bold tracking-wider block">Out for Delivery</span>
                    </div>

                    <!-- Step 4: Delivered -->
                    <div class="text-center">
                        <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs mb-1.5 shadow-sm
                            {{ $order->status === 'delivered' ? 'bg-emerald-700 text-white' : 'bg-stone-200 text-stone-500' }}">
                            4
                        </div>
                        <span class="text-[10px] sm:text-xs uppercase font-bold tracking-wider block">Delivered</span>
                    </div>
                </div>

                <!-- Dynamic Status Message Box -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-black/5 shadow-inner">
                    
                    @if($order->status === 'pending')
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0 animate-pulse">
                                <i data-lucide="clock" class="w-6 h-6"></i>
                            </div>
                            <div class="space-y-1">
                                <div class="inline-block bg-amber-200/80 text-amber-900 text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-0.5 rounded">
                                    Status: Pending Confirmation
                                </div>
                                <h3 class="text-xl font-sans font-bold tracking-tight text-amber-950">
                                    Your order has been placed.
                                </h3>
                                <p class="text-xs sm:text-sm text-amber-900/90 leading-relaxed font-medium">
                                    Please wait for the confirmation of the admin. Our team will review your order details and begin preparing your freshly packed matcha shortly.
                                </p>
                            </div>
                        </div>

                    @elseif($order->status === 'preparing')
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center flex-shrink-0 animate-bounce">
                                <i data-lucide="package-check" class="w-6 h-6"></i>
                            </div>
                            <div class="space-y-1">
                                <div class="inline-block bg-blue-200/80 text-blue-900 text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-0.5 rounded">
                                    Status: In Preparation
                                </div>
                                <h3 class="text-xl font-sans font-bold tracking-tight text-blue-950">
                                    Preparing your order
                                </h3>
                                <p class="text-xs sm:text-sm text-blue-900/90 leading-relaxed">
                                    Your items are currently being carefully weighed, nitrogen-sealed, and packaged by our team for shipment.
                                </p>
                                @if($order->preparing_at)
                                    <p class="text-[11px] text-blue-800 font-mono">Started preparation: {{ $order->preparing_at->format('M d, Y h:i A') }}</p>
                                @endif
                            </div>
                        </div>

                    @elseif($order->status === 'out_for_delivery')
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="truck" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-1">
                                    <div class="inline-block bg-purple-200/80 text-purple-900 text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-0.5 rounded">
                                        Status: Out for Delivery
                                    </div>
                                    <h3 class="text-xl font-sans font-bold tracking-tight text-purple-950">
                                        Out for delivery
                                    </h3>
                                    <p class="text-xs sm:text-sm text-purple-900/90 leading-relaxed">
                                        Your package has been dispatched with our delivery partner ({{ $order->tracking_courier ?? 'Express Courier' }}) and is on its way to your delivery address!
                                    </p>
                                    @if($order->out_for_delivery_at)
                                        <p class="text-[11px] text-purple-800 font-mono">Dispatched on: {{ $order->out_for_delivery_at->format('M d, Y h:i A') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Live Tracking Link Card / Button -->
                            @if($order->tracking_link)
                                <div class="mt-4 p-5 rounded-xl bg-gradient-to-r from-purple-900 to-matcha-900 text-white shadow-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div class="space-y-1">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-gold-400 block">
                                            🔴 Real-Time Courier Tracking
                                        </span>
                                        <p class="text-xs text-cream-200 font-light">
                                            Delivery Partner: <strong>{{ $order->tracking_courier ?? 'Express Delivery Courier' }}</strong>
                                        </p>
                                    </div>

                                    <a href="{{ $order->tracking_link }}" target="_blank" rel="noopener noreferrer" class="px-6 py-3 bg-gold-500 hover:bg-gold-400 text-stone-950 text-xs font-bold uppercase tracking-widest rounded-lg shadow-lg flex items-center gap-2 transition-all">
                                        <span>Open Live Tracking Map</span>
                                        <i data-lucide="external-link" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            @endif
                        </div>

                    @elseif($order->status === 'delivered')
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check-check" class="w-6 h-6"></i>
                            </div>
                            <div class="space-y-1">
                                <div class="inline-block bg-emerald-200/80 text-emerald-900 text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-0.5 rounded">
                                    Status: Delivered & Received
                                </div>
                                <h3 class="text-xl font-sans font-bold tracking-tight text-emerald-950">
                                    Delivered / Completed
                                </h3>
                                <p class="text-xs sm:text-sm text-emerald-900/90 leading-relaxed">
                                    Your order has been successfully delivered. Arigatou gozaimasu for choosing Coffee Base Philippines!
                                </p>
                            </div>
                        </div>

                    @else
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="x-circle" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-rose-950">Order Cancelled</h3>
                                <p class="text-xs text-rose-800">This order was cancelled. Please contact support if you have any questions.</p>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>

        <!-- Order Items & Receipt Details -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Items Purchased -->
            <div class="lg:col-span-7 bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-6">
                <h3 class="text-base font-sans font-bold tracking-tight text-stone-900 pb-3 border-b border-stone-100 flex items-center justify-between">
                    <span>Items in this Order</span>
                    <span class="text-xs font-mono text-stone-500 font-normal">({{ $order->items->count() }} items)</span>
                </h3>

                <div class="divide-y divide-stone-100">
                    @foreach($order->items as $item)
                        <div class="py-4 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
                            <div class="space-y-1">
                                <h4 class="text-sm font-bold text-stone-900">{{ $item->product_name }}</h4>
                                <p class="text-xs font-mono text-matcha-800">
                                    Weight: {{ $item->variant_weight }} × {{ $item->quantity }}
                                </p>
                                <p class="text-xs text-stone-400">₱{{ number_format($item->unit_price, 2) }} unit price</p>
                            </div>

                            <span class="text-sm font-sans font-bold text-stone-900">
                                ₱{{ number_format($item->subtotal, 2) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-stone-100 space-y-2 text-xs">
                    <div class="flex justify-between text-base font-sans font-bold text-matcha-950">
                        <span>Total Amount</span>
                        <span>₱{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer & Delivery Address Card -->
            <div class="lg:col-span-5 bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-6">
                <h3 class="text-base font-sans font-bold tracking-tight text-stone-900 pb-3 border-b border-stone-100">
                    Delivery & Customer Details
                </h3>

                <div class="space-y-4 text-xs">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Customer</span>
                        <p class="font-bold text-stone-900 text-sm">{{ $order->customer_full_name }}</p>
                        <p class="text-stone-600">{{ $order->customer_email }}</p>
                        <p class="text-stone-600 font-mono">{{ $order->customer_phone }}</p>
                        @if($order->company)
                            <p class="text-stone-500 italic mt-0.5">Company: {{ $order->company }}</p>
                        @endif
                    </div>

                    <div class="pt-3 border-t border-stone-100">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Delivery Address</span>
                        <p class="text-stone-800 leading-relaxed font-medium">
                            {{ $order->full_address }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-stone-100">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Payment Details</span>
                        <p class="font-semibold text-stone-900">{{ $order->payment_method }}</p>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            Payment {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>

                    @if($order->customer_notes)
                        <div class="pt-3 border-t border-stone-100">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Delivery Note</span>
                            <p class="text-stone-600 italic bg-stone-50 p-2.5 rounded border border-stone-200">"{{ $order->customer_notes }}"</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection
