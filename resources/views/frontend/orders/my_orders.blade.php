@extends('layouts.app')

@section('title', 'My Order History | Coffee Base Philippines')

@section('content')

    <!-- Header Banner -->
    <div class="bg-cream-100/70 border-b border-cream-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950">My Orders</h1>
                <p class="text-xs text-stone-500 uppercase tracking-widest mt-1">Track and review your past matcha shipments</p>
            </div>
            <div>
                <a href="{{ route('shop.index') }}" class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 rounded-xl text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-2 shadow-sm">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                    <span>Order More Matcha</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if($orders->isEmpty())
            <div class="bg-white rounded-3xl border border-stone-200 p-12 text-center max-w-lg mx-auto shadow-sm">
                <div class="w-16 h-16 rounded-full bg-cream-100 text-matcha-700 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="package-x" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-sans font-bold tracking-tight text-stone-900">No Orders Placed Yet</h3>
                <p class="text-xs text-stone-500 mt-2 font-light leading-relaxed">When you place an order, its real-time preparation and live courier tracking status will appear here.</p>
                <a href="{{ route('shop.index') }}" class="inline-block mt-6 px-6 py-3 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow">
                    Explore Matcha Catalog
                </a>
            </div>
        @else
            <!-- Data Table Card Container -->
            <div class="bg-white rounded-3xl border border-stone-200/90 shadow-sm p-6 sm:p-8">
                
                <div class="overflow-x-auto">
                    <table id="my-orders-table" class="w-full text-left text-xs stripe hover">
                        <thead>
                            <tr class="bg-stone-50 text-stone-600 uppercase font-bold tracking-wider text-[11px] border-b border-stone-200">
                                <th class="py-4 px-4 pl-6 rounded-l-xl">Order Ref #</th>
                                <th class="py-4 px-4">Date Placed</th>
                                <th class="py-4 px-4">Items / Details</th>
                                <th class="py-4 px-4">Payment</th>
                                <th class="py-4 px-4">Total Amount</th>
                                <th class="py-4 px-4">Live Status</th>
                                <th class="py-4 px-4 pr-6 text-right rounded-r-xl">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach($orders as $order)
                                <tr class="hover:bg-cream-50/60 transition-colors">
                                    <!-- Order Number -->
                                    <td class="py-4 px-4 pl-6 font-mono font-bold text-matcha-900">
                                        <a href="{{ route('orders.show', $order->order_number) }}" class="hover:underline flex items-center gap-1.5 text-xs">
                                            <i data-lucide="file-text" class="w-3.5 h-3.5 text-stone-400"></i>
                                            <span>{{ $order->order_number }}</span>
                                        </a>
                                    </td>

                                    <!-- Date -->
                                    <td class="py-4 px-4 text-stone-600 font-medium" data-sort="{{ $order->created_at->timestamp }}">
                                        {{ $order->created_at->format('M d, Y') }}
                                        <span class="block text-[10px] text-stone-400 font-mono">{{ $order->created_at->format('h:i A') }}</span>
                                    </td>

                                    <!-- Items -->
                                    <td class="py-4 px-4 text-stone-800">
                                        <span class="font-semibold block">{{ $order->items->count() }} item(s)</span>
                                        <span class="text-[11px] text-stone-500 line-clamp-1">
                                            {{ $order->items->pluck('product_name')->join(', ') }}
                                        </span>
                                    </td>

                                    <!-- Payment -->
                                    <td class="py-4 px-4 text-stone-700">
                                        <span class="font-medium text-[11px]">{{ $order->payment_method }}</span>
                                        <span class="block text-[10px] uppercase font-bold {{ $order->payment_status === 'paid' ? 'text-emerald-700' : 'text-amber-700' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>

                                    <!-- Total Amount -->
                                    <td class="py-4 px-4 font-sans font-bold text-stone-950 text-sm" data-sort="{{ $order->total_amount }}">
                                        ₱{{ number_format($order->total_amount, 2) }}
                                    </td>

                                    <!-- Live Status Badge -->
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                            @if($order->status === 'pending') bg-amber-100 text-amber-900 border border-amber-300
                                            @elseif($order->status === 'preparing') bg-blue-100 text-blue-900 border border-blue-300
                                            @elseif($order->status === 'out_for_delivery') bg-purple-100 text-purple-900 border border-purple-300
                                            @elseif($order->status === 'delivered') bg-emerald-100 text-emerald-900 border border-emerald-300
                                            @else bg-rose-100 text-rose-900 border border-rose-300 @endif">
                                            {{ $order->status_label }}
                                        </span>
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="py-4 px-4 pr-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if($order->tracking_link)
                                                <a href="{{ $order->tracking_link }}" target="_blank" rel="noopener noreferrer" 
                                                    class="p-2 rounded-lg bg-purple-50 text-purple-800 hover:bg-purple-100 border border-purple-200 transition-colors"
                                                    title="Open Live Courier Tracking">
                                                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('orders.show', $order->order_number) }}" 
                                                class="px-3 py-1.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1 shadow-xs">
                                                <span>Track</span>
                                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endif
    </div>

@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<style>
    /* DataTables Matcha Theme Customizations */
    .dataTables_wrapper {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        font-size: 0.8125rem;
    }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1.25rem;
    }
    .dataTables_wrapper .dataTables_length select {
        padding: 0.35rem 2rem 0.35rem 0.75rem;
        border: 1px solid #e7e5e4;
        border-radius: 0.5rem;
        outline: none;
        font-size: 0.75rem;
        background-color: #fff;
    }
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #3d664a;
        box-shadow: 0 0 0 1px #3d664a;
    }
    .dataTables_wrapper .dataTables_filter input {
        padding: 0.4rem 0.85rem;
        border: 1px solid #e7e5e4;
        border-radius: 0.5rem;
        outline: none;
        font-size: 0.75rem;
        margin-left: 0.5rem;
        background-color: #fff;
        min-width: 200px;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #3d664a;
        box-shadow: 0 0 0 1px #3d664a;
    }
    .dataTables_wrapper .dataTables_info {
        padding-top: 1.25rem;
        color: #78716c;
        font-size: 0.75rem;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.35rem 0.75rem !important;
        border-radius: 0.5rem !important;
        border: 1px solid #e7e5e4 !important;
        background: #fff !important;
        color: #292524 !important;
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f5f5f4 !important;
        border-color: #d6d3d1 !important;
        color: #0c0a09 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #284131 !important;
        border-color: #284131 !important;
        color: #fbfaf2 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        opacity: 0.4;
        cursor: not-allowed;
    }
    table.dataTable thead th {
        position: relative;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {
        $('#my-orders-table').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[1, 'desc']], // Sort by Date Placed (descending) by default
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search orders, refs, status...",
                lengthMenu: "Show _MENU_ orders per page",
                info: "Showing _START_ to _END_ of _TOTAL_ orders",
                infoEmpty: "No orders to display",
                infoFiltered: "(filtered from _MAX_ total orders)",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                }
            },
            drawCallback: function() {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        });
    });
</script>
@endsection
