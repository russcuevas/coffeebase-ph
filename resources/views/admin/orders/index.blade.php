@extends('layouts.admin')

@section('title', 'Order Management')
@section('page_title', 'Customer Orders & Dispatch Fulfillment')

@section('content')

    <!-- Status Stats / Quick Filter -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
        <button type="button" onclick="filterByStatus('')" class="status-pill p-3 bg-white hover:bg-stone-50 border border-stone-200 rounded-2xl text-left transition-all shadow-xs focus:ring-2 focus:ring-matcha-600">
            <span class="text-[10px] font-bold uppercase text-stone-400 tracking-wider block">All Orders</span>
            <span class="text-lg font-extrabold text-stone-900">{{ $statusCounts['all'] }}</span>
        </button>
        <button type="button" onclick="filterByStatus('Pending')" class="status-pill p-3 bg-amber-50/50 hover:bg-amber-50 border border-amber-200 rounded-2xl text-left transition-all shadow-xs focus:ring-2 focus:ring-amber-500">
            <span class="text-[10px] font-bold uppercase text-amber-700 tracking-wider block">Pending</span>
            <span class="text-lg font-extrabold text-amber-800">{{ $statusCounts['pending'] }}</span>
        </button>
        <button type="button" onclick="filterByStatus('Preparing')" class="status-pill p-3 bg-blue-50/50 hover:bg-blue-50 border border-blue-200 rounded-2xl text-left transition-all shadow-xs focus:ring-2 focus:ring-blue-500">
            <span class="text-[10px] font-bold uppercase text-blue-700 tracking-wider block">Preparing</span>
            <span class="text-lg font-extrabold text-blue-800">{{ $statusCounts['preparing'] }}</span>
        </button>
        <button type="button" onclick="filterByStatus('Out for Delivery')" class="status-pill p-3 bg-purple-50/50 hover:bg-purple-50 border border-purple-200 rounded-2xl text-left transition-all shadow-xs focus:ring-2 focus:ring-purple-500">
            <span class="text-[10px] font-bold uppercase text-purple-700 tracking-wider block">Out for Delivery</span>
            <span class="text-lg font-extrabold text-purple-800">{{ $statusCounts['out_for_delivery'] }}</span>
        </button>
        <button type="button" onclick="filterByStatus('Delivered')" class="status-pill p-3 bg-emerald-50/50 hover:bg-emerald-50 border border-emerald-200 rounded-2xl text-left transition-all shadow-xs focus:ring-2 focus:ring-emerald-500">
            <span class="text-[10px] font-bold uppercase text-emerald-700 tracking-wider block">Delivered</span>
            <span class="text-lg font-extrabold text-emerald-800">{{ $statusCounts['delivered'] }}</span>
        </button>
        <button type="button" onclick="filterByStatus('Cancelled')" class="status-pill p-3 bg-rose-50/50 hover:bg-rose-50 border border-rose-200 rounded-2xl text-left transition-all shadow-xs focus:ring-2 focus:ring-rose-500">
            <span class="text-[10px] font-bold uppercase text-rose-700 tracking-wider block">Cancelled</span>
            <span class="text-lg font-extrabold text-rose-800">{{ $statusCounts['cancelled'] }}</span>
        </button>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
        <div class="overflow-x-auto">
            <table id="orders-table" class="w-full text-left text-xs stripe hover">
                <thead class="bg-stone-50 text-stone-500 uppercase tracking-wider border-b border-stone-200">
                    <tr>
                        <th class="p-3 pl-4">Order Ref</th>
                        <th class="p-3">Customer & Contact</th>
                        <th class="p-3">Delivery Address</th>
                        <th class="p-3">Ordered Items</th>
                        <th class="p-3">Total Amount</th>
                        <th class="p-3">Fulfillment Status</th>
                        <th class="p-3 text-right pr-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($orders as $order)
                        <tr class="hover:bg-stone-50/80 transition-colors">
                            
                            <!-- Ref -->
                            <td class="p-3 pl-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="font-mono font-bold text-matcha-950 text-sm hover:underline block">
                                    {{ $order->order_number }}
                                </a>
                                <span class="text-[11px] text-stone-400 font-mono">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                            </td>

                            <!-- Customer -->
                            <td class="p-3">
                                <p class="font-bold text-stone-900">{{ $order->customer_full_name }}</p>
                                <p class="text-stone-500 font-mono text-[11px]">{{ $order->customer_phone }}</p>
                                <p class="text-stone-400 text-[10px] truncate max-w-[140px]">{{ $order->customer_email }}</p>
                            </td>

                            <!-- Address -->
                            <td class="p-3 text-stone-600 max-w-xs">
                                <p class="font-semibold text-stone-800">{{ $order->city }}, {{ $order->region }}</p>
                                <p class="text-[11px] text-stone-500 truncate">{{ $order->barangay }}, {{ $order->address }}</p>
                            </td>

                            <!-- Items -->
                            <td class="p-3">
                                <div class="space-y-1 max-w-xs">
                                    @foreach($order->items as $item)
                                        <div class="text-[11px] text-stone-700">
                                            <strong class="font-bold text-stone-900">{{ $item->quantity }}x</strong> {{ $item->product_name }} <span class="font-mono text-matcha-800 font-medium">({{ $item->variant_weight }})</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <!-- Amount & Payment -->
                            <td class="p-3 whitespace-nowrap">
                                <span class="font-serif font-bold text-stone-900 text-sm block">₱{{ number_format($order->total_amount, 2) }}</span>
                                <span class="inline-block mt-0.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-stone-100 text-stone-600 border border-stone-200">{{ $order->payment_method }}</span>
                            </td>

                            <!-- Status & Tracking Link Indicator -->
                            <td class="p-3 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider block text-center max-w-[140px]
                                    @if($order->status === 'pending') bg-amber-100 text-amber-800 border border-amber-300
                                    @elseif($order->status === 'preparing') bg-blue-100 text-blue-800 border border-blue-300
                                    @elseif($order->status === 'out_for_delivery') bg-purple-100 text-purple-800 border border-purple-300
                                    @elseif($order->status === 'delivered') bg-emerald-100 text-emerald-800 border border-emerald-300
                                    @else bg-rose-100 text-rose-800 border border-rose-300 @endif">
                                    {{ $order->status_label }}
                                </span>

                                @if($order->tracking_link)
                                    <a href="{{ $order->tracking_link }}" target="_blank" class="mt-1 text-[10px] text-purple-700 font-bold hover:underline flex items-center justify-center gap-1">
                                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                                        <span>{{ $order->tracking_courier ?? 'Track Package' }}</span>
                                    </a>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="p-3 text-right pr-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3.5 py-2 bg-matcha-700 hover:bg-matcha-800 text-white rounded-xl text-xs font-semibold uppercase tracking-wider transition-all shadow-xs inline-flex items-center gap-1">
                                    <span>Manage</span>
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let ordersTable;
    $(document).ready(function() {
        ordersTable = $('#orders-table').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'desc']], // Sort by Ref / Created At desc
            columnDefs: [{ orderable: false, targets: -1 }],
            language: {
                search: "",
                searchPlaceholder: "Search order #, customer, address...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ orders",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                }
            }
        });

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });

    function filterByStatus(status) {
        if (ordersTable) {
            ordersTable.column(5).search(status).draw();
        }
    }
</script>
@endpush
