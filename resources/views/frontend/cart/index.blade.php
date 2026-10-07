@extends('layouts.app')

@section('title', 'Shopping Cart | Coffee Base Philippines')

@section('content')

    <div class="bg-cream-100/70 border-b border-cream-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950">Your Shopping Cart</h1>
            <p class="text-xs text-stone-500 uppercase tracking-widest mt-1">Review your selected matcha items</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(empty($cart) || count($cart) === 0)
            <div class="bg-white rounded-2xl border border-stone-200 p-12 text-center max-w-xl mx-auto shadow-sm">
                <div class="w-16 h-16 rounded-full bg-matcha-50 text-matcha-700 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="shopping-bag" class="w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-sans font-bold tracking-tight text-stone-900">Your Cart is Currently Empty</h2>
                <p class="text-xs text-stone-500 mt-2 font-light">Explore our ceremonial grade matcha and single origin harvests to begin.</p>
                <a href="{{ route('shop.index') }}" class="inline-block mt-6 px-8 py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md transition-all">
                    Explore Matcha Catalog
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Cart Items Table / List -->
                <div class="lg:col-span-8 bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-stone-100 flex justify-between items-center bg-cream-50/50">
                        <span class="text-xs font-bold uppercase tracking-wider text-stone-800">Selected Items ({{ count($cart) }})</span>
                        <form id="clear-cart-form" action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmClearCart()" class="text-xs text-rose-600 hover:text-rose-800 font-medium">Clear Cart</button>
                        </form>
                    </div>

                    <div class="divide-y divide-stone-100">
                        @foreach($cart as $key => $item)
                            @php
                                $hasDiscount = !empty($item['discount_percent']) && $item['discount_percent'] > 0;
                            @endphp
                            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-cream-100 flex-shrink-0 border border-stone-200">
                                        <img src="{{ $item['image'] ?? '/uploads/products/samidori.jpg' }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="text-base font-sans font-bold tracking-tight text-stone-900">
                                            <a href="{{ route('shop.show', $item['slug']) }}" class="hover:text-matcha-800">{{ $item['name'] }}</a>
                                        </h3>
                                        <p class="text-xs font-mono text-matcha-800 font-semibold mt-0.5">
                                            Weight: {{ $item['weight'] }}
                                        </p>
                                        <div class="text-xs text-stone-500 mt-1 flex flex-wrap items-center gap-1.5">
                                            @if($hasDiscount)
                                                <span class="line-through text-stone-400 font-mono">₱{{ number_format($item['original_price'], 2) }}</span>
                                                <span class="font-bold text-matcha-950 font-mono">₱{{ number_format($item['price'], 2) }} each</span>
                                            @else
                                                <span class="font-mono">₱{{ number_format($item['price'], 2) }} each</span>
                                            @endif
                                        </div>
                                        @if($hasDiscount)
                                            <div class="mt-1.5">
                                                <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-800 text-[10px] font-mono font-bold px-2 py-0.5 rounded-md border border-emerald-200">
                                                    <i data-lucide="percent" class="w-3 h-3 text-emerald-600"></i>
                                                    <span>{{ $item['discount_label'] ?? $item['discount_percent'] . '% Bulk Tier Applied' }}</span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between sm:justify-end space-x-6">
                                    <!-- Quantity Update -->
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-stone-300 rounded-lg overflow-hidden bg-stone-50">
                                        @csrf
                                        <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="999" class="w-16 text-center text-xs font-semibold py-1.5 focus:outline-none bg-white font-mono">
                                        <button type="submit" class="px-2.5 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 text-[10px] font-bold uppercase tracking-wider border-l border-stone-300" title="Update Quantity">
                                            Save
                                        </button>
                                    </form>

                                    <!-- Subtotal -->
                                    <div class="text-right min-w-[100px]">
                                        <span class="text-sm font-sans font-bold text-matcha-950 block">
                                            ₱{{ number_format($item['line_total'], 2) }}
                                        </span>
                                        @if($hasDiscount && $item['line_savings'] > 0)
                                            <span class="text-[10px] text-emerald-700 font-mono block">
                                                Saved ₱{{ number_format($item['line_savings'], 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Remove Button -->
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                        <button type="submit" class="text-stone-400 hover:text-rose-600 p-1" title="Remove item">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="lg:col-span-4 bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-6">
                    <h3 class="text-lg font-sans font-bold tracking-tight text-stone-900 pb-3 border-b border-stone-100">
                        Order Summary
                    </h3>

                    <div class="space-y-3 text-xs">
                        @if(isset($totalSavings) && $totalSavings > 0)
                            <div class="flex justify-between text-stone-600">
                                <span>Original Price</span>
                                <span class="font-mono">₱{{ number_format($originalSubtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-emerald-700 font-bold bg-emerald-50 p-2 rounded-lg border border-emerald-200">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                    <span>Bulk Tier Discount</span>
                                </span>
                                <span class="font-mono">-₱{{ number_format($totalSavings, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between text-base font-sans font-bold text-matcha-950 pt-2 border-t border-stone-100">
                            <span>Total Amount</span>
                            <span class="font-mono">₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    <p class="text-[11px] text-stone-500 bg-stone-50 p-3 rounded-lg border border-stone-200 leading-relaxed">
                        <i data-lucide="truck" class="w-3.5 h-3.5 inline text-matcha-700 mr-1"></i>
                        <span>Delivery / Courier booking is arranged upon admin confirmation with real-time tracking link.</span>
                    </p>

                    <a href="{{ route('checkout.index') }}" class="w-full py-4 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all text-center block">
                        Proceed to Checkout
                    </a>

                    <div class="text-center text-[10px] text-stone-400">
                        <span>Includes VAT & Direct Import Duties</span>
                    </div>
                </div>

            </div>
        @endif
    </div>

@endsection

@section('scripts')
<script>
    function confirmClearCart() {
        Swal.fire({
            title: 'Clear Shopping Bag?',
            text: 'Are you sure you want to remove all items from your bag?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#284131',
            cancelButtonColor: '#78716c',
            confirmButtonText: 'Yes, clear it',
            cancelButtonText: 'Keep items',
            background: '#ffffff',
            color: '#1b2c21',
            customClass: {
                popup: 'rounded-2xl shadow-xl border border-stone-200',
                confirmButton: 'rounded-xl px-5 py-2.5 text-xs font-bold uppercase tracking-wider',
                cancelButton: 'rounded-xl px-5 py-2.5 text-xs font-semibold uppercase tracking-wider'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('clear-cart-form').submit();
            }
        });
    }
</script>
@endsection
