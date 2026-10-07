@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Matcha Operations Overview')

@section('content')

    <!-- KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Revenue -->
        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500 block">Total Sales</span>
                <span class="text-2xl font-serif font-bold text-matcha-950 mt-1 block">₱{{ number_format($totalSales, 2) }}</span>
                <span class="text-[10px] text-emerald-700 font-bold uppercase mt-1 block">Paid Orders Only</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <i data-lucide="banknote" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500 block">Pending Orders</span>
                <span class="text-2xl font-serif font-bold text-amber-900 mt-1 block">{{ $pendingOrdersCount }}</span>
                <span class="text-[10px] text-amber-700 font-bold uppercase mt-1 block">Awaiting Confirmation</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <i data-lucide="clock" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- In Preparation -->
        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500 block">Preparing</span>
                <span class="text-2xl font-serif font-bold text-blue-900 mt-1 block">{{ $preparingOrdersCount }}</span>
                <span class="text-[10px] text-blue-700 font-bold uppercase mt-1 block">Packing & Sealing</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                <i data-lucide="box" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Out for Delivery -->
        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500 block">Out for Delivery</span>
                <span class="text-2xl font-serif font-bold text-purple-900 mt-1 block">{{ $outForDeliveryCount }}</span>
                <span class="text-[10px] text-purple-700 font-bold uppercase mt-1 block">Live Courier Dispatched</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center">
                <i data-lucide="truck" class="w-6 h-6"></i>
            </div>
        </div>

    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-admincard text-white p-5 rounded-xl flex items-center justify-between border border-matcha-700">
            <div>
                <span class="text-xs text-gold-400 font-semibold uppercase tracking-wider">Active Products</span>
                <p class="text-2xl font-bold font-serif">{{ $totalProductsCount }} matcha items</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-cream-200 hover:text-white underline">Manage →</a>
        </div>

        <div class="bg-admincard text-white p-5 rounded-xl flex items-center justify-between border border-matcha-700">
            <div>
                <span class="text-xs text-gold-400 font-semibold uppercase tracking-wider">Registered Customers</span>
                <p class="text-2xl font-bold font-serif">{{ $totalCustomersCount }} clients</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-cream-200 hover:text-white underline">View List →</a>
        </div>

        <div class="bg-admincard text-white p-5 rounded-xl flex items-center justify-between border border-matcha-700">
            <div>
                <span class="text-xs text-gold-400 font-semibold uppercase tracking-wider">Unread Inquiries</span>
                <p class="text-2xl font-bold font-serif">{{ $unreadMessagesCount }} new messages</p>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="text-xs text-cream-200 hover:text-white underline">Check CRM →</a>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-stone-100 flex justify-between items-center bg-stone-50/50">
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900">Recent Customer Orders</h3>
                <p class="text-xs text-stone-500">Monitor status transitions and update courier tracking links</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-matcha-800 hover:underline uppercase tracking-wider">
                View All Orders →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 text-stone-500 uppercase tracking-wider border-b border-stone-200">
                    <tr>
                        <th class="p-4 pl-6">Order Ref</th>
                        <th class="p-4">Customer</th>
                        <th class="p-4">Destination</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Courier / Tracking</th>
                        <th class="p-4 text-right pr-6">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-stone-50/80 transition-colors">
                            <td class="p-4 pl-6 font-mono font-bold text-matcha-950">
                                {{ $order->order_number }}
                            </td>
                            <td class="p-4">
                                <p class="font-semibold text-stone-900">{{ $order->customer_full_name }}</p>
                                <p class="text-stone-500 font-mono text-[11px]">{{ $order->customer_phone }}</p>
                            </td>
                            <td class="p-4 text-stone-600">
                                {{ $order->city }}, {{ $order->region }}
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="font-serif font-bold text-stone-900 text-sm block">₱{{ number_format($order->total_amount, 2) }}</span>
                                <div class="mt-1 flex items-center gap-1">
                                    <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-bold uppercase {{ $order->payment_method === 'E-Payment' ? 'bg-purple-100 text-purple-900 border border-purple-200' : 'bg-stone-100 text-stone-600' }}">
                                        {{ $order->payment_method }}
                                    </span>
                                    <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-extrabold uppercase {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($order->status === 'pending') bg-amber-100 text-amber-800 border border-amber-300
                                    @elseif($order->status === 'preparing') bg-blue-100 text-blue-800 border border-blue-300
                                    @elseif($order->status === 'out_for_delivery') bg-purple-100 text-purple-800 border border-purple-300
                                    @elseif($order->status === 'delivered') bg-emerald-100 text-emerald-800 border border-emerald-300
                                    @else bg-rose-100 text-rose-800 border border-rose-300 @endif">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="p-4">
                                @if($order->tracking_link)
                                    <a href="{{ $order->tracking_link }}" target="_blank" class="inline-flex items-center gap-1 text-purple-700 font-bold hover:underline">
                                        <span>{{ $order->tracking_courier ?? 'Tracking Link' }}</span>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                @else
                                    <span class="text-stone-400 italic">No link added</span>
                                @endif
                            </td>
                            <td class="p-4 text-right pr-6">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1.5 bg-matcha-700 hover:bg-matcha-800 text-white rounded text-xs font-semibold uppercase tracking-wider">
                                    Update
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-stone-400">No recent orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
