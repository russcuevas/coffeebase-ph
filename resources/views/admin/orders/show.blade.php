@extends('layouts.admin')

@section('title', "Order #{$order->order_number}")
@section('page_title', "Order Fulfillment: #{$order->order_number}")

@section('content')

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-matcha-800 font-semibold hover:underline flex items-center gap-1 mb-1">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Back to Orders List</span>
            </a>
            <h1 class="text-xl font-serif font-bold text-stone-900">Reference: #{{ $order->order_number }}</h1>
        </div>

        <a href="{{ route('orders.show', $order->order_number) }}" target="_blank" class="px-4 py-2 bg-white border border-stone-300 text-stone-700 rounded-lg text-xs font-semibold uppercase tracking-wider hover:bg-stone-50 flex items-center gap-1.5 shadow-sm">
            <i data-lucide="external-link" class="w-3.5 h-3.5 text-gold-500"></i>
            <span>View Client Live Tracking Page</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Order Status Updater & Courier Tracking Input -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Status Update Action Card -->
            <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-5">
                <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-3 border-b border-stone-100 flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-4 h-4 text-gold-500"></i>
                    <span>Update Order & Courier Dispatch Status</span>
                </h3>

                <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="admin_order_status" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Order Fulfillment Stage *</label>
                        <select id="admin_order_status" name="status" required class="w-full px-4 py-3 rounded-xl border border-stone-300 text-sm font-semibold focus:ring-2 focus:ring-matcha-600 outline-none bg-white">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>1. Pending Confirmation (Waiting for Admin)</option>
                            <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>2. Preparing (Packing & Sealing Matcha)</option>
                            <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>3. Out for Delivery (Rider Dispatched)</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>4. Delivered / Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>5. Cancel Order</option>
                        </select>
                    </div>

                    <!-- Courier Tracking Information -->
                    <div class="bg-purple-50 p-5 rounded-xl border border-purple-200 space-y-3">
                        <div class="flex items-center space-x-2 text-purple-950">
                            <i data-lucide="truck" class="w-4 h-4 text-purple-700"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Delivery Courier & Live Tracking Link</span>
                        </div>
                        <p class="text-[11px] text-purple-900/80">
                            When you book an external courier or delivery service, paste the shareable live tracking map/URL below. The client will immediately see a button on their order page to track the driver in real-time.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-1">
                                <label for="admin_courier_name" class="block text-[10px] font-bold uppercase tracking-wider text-purple-900 mb-1">Courier / Delivery Service</label>
                                <input type="text" id="admin_courier_name" name="tracking_courier" value="{{ old('tracking_courier', $order->tracking_courier ?? 'Express Delivery Courier') }}" placeholder="e.g. Courier Express" class="w-full px-3 py-2 rounded-lg border border-purple-300 text-xs focus:ring-2 focus:ring-purple-600 outline-none bg-white">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="admin_courier_link" class="block text-[10px] font-bold uppercase tracking-wider text-purple-900 mb-1">Live Tracking URL / Map Link</label>
                                <input type="url" id="admin_courier_link" name="tracking_link" value="{{ old('tracking_link', $order->tracking_link) }}" placeholder="https://track.courier.ph/order-track?..." class="w-full px-3 py-2 rounded-lg border border-purple-300 text-xs focus:ring-2 focus:ring-purple-600 outline-none bg-white font-mono">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="admin_payment_status" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Payment Status</label>
                            <select id="admin_payment_status" name="payment_status" class="w-full px-3 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none bg-white font-semibold">
                                <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending Payment</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Payment Confirmed / Paid</option>
                                <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>

                        <div>
                            <label for="admin_notes" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Internal Admin Notes</label>
                            <input type="text" id="admin_notes" name="admin_notes" value="{{ old('admin_notes', $order->admin_notes) }}" placeholder="e.g. Nitrogen-flushed batch #048" class="w-full px-3 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-xl shadow-md transition-all flex items-center justify-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Save Status & Tracking Info</span>
                    </button>
                </form>

            </div>

            <!-- Items Breakdown -->
            <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900 pb-3 border-b border-stone-100">
                    Purchased Matcha Items
                </h3>

                <div class="divide-y divide-stone-100">
                    @foreach($order->items as $item)
                        <div class="py-3.5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-stone-900">{{ $item->product_name }}</p>
                                <p class="text-xs font-mono text-matcha-800 font-semibold">
                                    Weight: {{ $item->variant_weight }} • Qty: {{ $item->quantity }}
                                </p>
                                <p class="text-[11px] text-stone-400">₱{{ number_format($item->unit_price, 2) }} each</p>
                            </div>
                            <span class="text-sm font-serif font-bold text-stone-900">
                                ₱{{ number_format($item->subtotal, 2) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-stone-100 space-y-2 text-xs">
                    <div class="flex justify-between text-base font-serif font-bold text-matcha-950">
                        <span>Grand Total</span>
                        <span>₱{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right: Customer Info & Shipping Address -->
        <div class="lg:col-span-5 space-y-6">
            
            <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900 pb-2 border-b border-stone-100">
                    Customer Information
                </h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Name</span>
                        <p class="font-bold text-stone-900 text-sm">{{ $order->customer_full_name }}</p>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Email</span>
                        <a href="mailto:{{ $order->customer_email }}" class="text-matcha-800 font-semibold hover:underline">{{ $order->customer_email }}</a>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Contact Phone</span>
                        <a href="tel:{{ $order->customer_phone }}" class="text-stone-900 font-mono font-bold">{{ $order->customer_phone }}</a>
                    </div>

                    @if($order->company)
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Company / Cafe</span>
                            <p class="text-stone-800 font-medium">{{ $order->company }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900 pb-2 border-b border-stone-100">
                    Shipping Address (Philippines)
                </h3>

                <div class="space-y-2 text-xs text-stone-700">
                    <p class="font-bold text-stone-900">{{ $order->address }}</p>
                    @if($order->apartment)
                        <p class="text-stone-600">{{ $order->apartment }}</p>
                    @endif
                    <p class="text-stone-600">{{ $order->barangay }}, {{ $order->city }}</p>
                    <p class="text-stone-600">{{ $order->region }} {{ $order->postal_code }}</p>
                    <p class="font-bold text-stone-800">{{ $order->country }}</p>

                    @if($order->customer_notes)
                        <div class="mt-3 p-3 bg-amber-50 rounded-lg border border-amber-200 text-amber-900">
                            <span class="text-[10px] font-bold uppercase tracking-wider block">Customer Note:</span>
                            <p class="italic text-[11px] mt-0.5">{{ $order->customer_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-3">
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900 pb-2 border-b border-stone-100">
                    Payment Method
                </h3>

                <div class="text-xs space-y-1">
                    <p class="font-bold text-stone-900">{{ $order->payment_method }}</p>
                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

        </div>

    </div>

@endsection
