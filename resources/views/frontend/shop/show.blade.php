@extends('layouts.app')

@section('title', "{$product->name} | Coffee Base Philippines")
@section('meta_description', strip_tags($product->description))

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-cream-100/70 border-b border-cream-300/80 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-xs text-stone-500 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-matcha-800">Home</a>
            <span>/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-matcha-800">Shop</a>
            <span>/</span>
            <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-matcha-800">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-stone-900 font-medium truncate">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Showcase -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left: Product Image -->
            <div class="lg:col-span-6 sticky top-28">
                <div class="rounded-2xl overflow-hidden border border-stone-200/80 bg-white shadow-sm aspect-square relative group p-8 flex items-center justify-center">
                    <img id="main-product-image" src="{{ $product->primary_image ?: '/uploads/products/samidori.jpg' }}" alt="{{ $product->name }}" class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                    
                    @if($product->badge)
                        <span class="absolute top-4 left-4 bg-stone-900 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full shadow">
                            {{ $product->badge }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Right: Product Purchasing & Specs -->
            <div class="lg:col-span-6 space-y-8">
                
                <!-- Category & Title -->
                <div>
                    <div class="flex items-center gap-3 text-xs text-matcha-700 uppercase font-semibold tracking-widest">
                        <span>{{ $product->origin ?? 'Kyoto, Japan' }}</span>
                        <span>•</span>
                        <span>{{ $product->grade ?? 'Ceremonial Grade' }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-sans font-bold tracking-tight text-matcha-950 mt-1">
                        {{ $product->name }}
                    </h1>

                    @if($product->flavor_notes)
                        <div class="mt-2.5 inline-flex items-center gap-2 px-3 py-1 rounded-md bg-matcha-50 text-matcha-800 text-xs font-medium border border-matcha-200">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-gold-500"></i>
                            <span>{{ $product->flavor_notes }}</span>
                        </div>
                    @endif
                </div>

                <!-- Price Display -->
                <div class="bg-cream-50 p-5 rounded-xl border border-cream-300/80 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-stone-500 uppercase tracking-widest block font-medium">Selected Size Price</span>
                        <div class="flex items-baseline gap-3">
                            <span id="display-price" class="text-3xl font-sans font-bold tracking-tight text-matcha-950">
                                ₱{{ number_format($product->default_variant->price ?? $product->min_price, 2) }}
                            </span>
                            <span id="display-compare-price" class="text-sm line-through text-stone-400 font-mono hidden">
                            </span>
                        </div>
                    </div>

                    <!-- Stock Status Pill -->
                    <div>
                        <span id="stock-badge" class="px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">
                            In Stock
                        </span>
                    </div>
                </div>

                <!-- Short Description -->
                <p class="text-sm text-stone-600 leading-relaxed font-light">
                    {{ $product->description }}
                </p>

                <!-- Add to Cart Form with Variant Selector -->
                <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form" class="space-y-6 pt-4 border-t border-stone-200">
                    @csrf
                    <input type="hidden" name="variant_id" id="selected-variant-id" value="{{ $product->default_variant->id ?? '' }}">

                    <!-- Weight / Size Selection -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-stone-800">
                                Select Weight / Package
                            </label>
                            <span class="text-xs text-stone-500 font-mono" id="selected-weight-label">
                                {{ $product->default_variant->weight ?? '' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-3 gap-3">
                            @foreach($product->variants as $variant)
                                @php
                                    $isVarSoldOut = $variant->is_sold_out || $variant->stock_quantity <= 0;
                                    $isDefault = $loop->first;
                                @endphp
                                <button type="button"
                                    data-variant-id="{{ $variant->id }}"
                                    data-weight="{{ $variant->weight }}"
                                    data-price="{{ $variant->price }}"
                                    data-compare="{{ $variant->compare_at_price }}"
                                    data-sold-out="{{ $isVarSoldOut ? '1' : '0' }}"
                                    onclick="selectVariant(this)"
                                    class="variant-btn relative p-3 rounded-xl border-2 text-left transition-all {{ $isDefault ? 'border-matcha-700 bg-matcha-50/50 shadow-sm' : 'border-stone-200 bg-white hover:border-stone-300' }} {{ $isVarSoldOut ? 'opacity-60' : '' }}">
                                    
                                    <span class="block text-xs font-bold text-stone-900 {{ $isVarSoldOut ? 'line-through text-stone-400' : '' }}">
                                        {{ $variant->weight }}
                                    </span>
                                    <span class="block text-xs font-sans font-bold text-matcha-800 mt-1">
                                        ₱{{ number_format($variant->price, 2) }}
                                    </span>

                                    @if($isVarSoldOut)
                                        <span class="absolute -top-2 -right-1 bg-rose-600 text-white text-[8px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded">
                                            Sold Out
                                        </span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quantity & Submit -->
                    <div class="flex items-center gap-4">
                        <div class="w-32">
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-500 mb-1">Quantity</label>
                            <div class="flex items-center border border-stone-300 rounded-lg bg-white overflow-hidden">
                                <button type="button" onclick="decrementQty()" class="px-3 py-2 text-stone-500 hover:bg-stone-100 transition-colors">
                                    <i data-lucide="minus" class="w-4 h-4"></i>
                                </button>
                                <input type="number" id="quantity-input" name="quantity" value="1" min="1" max="99" class="w-full text-center text-sm font-semibold text-stone-900 focus:outline-none py-2">
                                <button type="button" onclick="incrementQty()" class="px-3 py-2 text-stone-500 hover:bg-stone-100 transition-colors">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex-1 pt-5">
                            <button type="submit" id="add-to-cart-btn" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                                <span id="btn-text">Add to Shopping Bag</span>
                            </button>
                        </div>
                    </div>

                </form>

                <!-- Matcha Specification Table (Structured Technical Sheet) -->
                <div class="pt-8 border-t border-stone-200">
                    <h3 class="text-lg font-sans font-bold tracking-tight text-matcha-950 mb-4 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-gold-500"></i>
                        <span>Matcha Technical Specifications</span>
                    </h3>

                    <div class="bg-white rounded-xl border border-stone-200 overflow-hidden divide-y divide-stone-100 text-xs shadow-sm">
                        
                        @if($product->grade)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Grade</span>
                                <span class="col-span-2 text-stone-900 font-semibold">{{ $product->grade }}</span>
                            </div>
                        @endif

                        @if($product->flavor_notes)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Flavor Notes</span>
                                <span class="col-span-2 text-stone-900">{{ $product->flavor_notes }}</span>
                            </div>
                        @endif

                        @if($product->origin)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Origin</span>
                                <span class="col-span-2 text-stone-900 font-medium">{{ $product->origin }}</span>
                            </div>
                        @endif

                        @if($product->cultivar)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Cultivar</span>
                                <span class="col-span-2 text-stone-900 font-medium">{{ $product->cultivar }}</span>
                            </div>
                        @endif

                        @if($product->harvest)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Harvest</span>
                                <span class="col-span-2 text-stone-900">{{ $product->harvest }}</span>
                            </div>
                        @endif

                        @if($product->milling)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Milling</span>
                                <span class="col-span-2 text-stone-900">{{ $product->milling }}</span>
                            </div>
                        @endif

                        @if($product->picking)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Picking</span>
                                <span class="col-span-2 text-stone-900">{{ $product->picking }}</span>
                            </div>
                        @endif

                        @if($product->recommended_for)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Recommended For</span>
                                <span class="col-span-2 text-stone-900 whitespace-pre-line">{{ $product->recommended_for }}</span>
                            </div>
                        @endif

                        @if($product->storage)
                            <div class="grid grid-cols-3 p-3.5 hover:bg-stone-50/50">
                                <span class="font-bold text-stone-500 uppercase tracking-wider">Storage</span>
                                <span class="col-span-2 text-stone-900 whitespace-pre-line">{{ $product->storage }}</span>
                            </div>
                        @endif

                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- You may also like Section -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="border-t border-stone-200 bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl font-sans font-bold tracking-tight text-stone-950 mb-12">
                    You may also like
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-12">
                    @foreach ($relatedProducts as $relProduct)
                        @php
                            $isRelSoldOut = $relProduct->is_sold_out;
                            $relMinPrice = $relProduct->min_price;
                            $relProductData = [
                                'id' => $relProduct->id,
                                'name' => $relProduct->name,
                                'slug' => $relProduct->slug,
                                'image' => $relProduct->primary_image ?: '/uploads/products/samidori.jpg',
                                'variants' => $relProduct->variants->map(fn($v) => [
                                    'id' => $v->id,
                                    'weight' => $v->weight,
                                    'price' => (float)$v->price,
                                    'compare_at_price' => $v->compare_at_price ? (float)$v->compare_at_price : null,
                                    'is_sold_out' => (bool)($v->is_sold_out || $v->stock_quantity <= 0),
                                ])->values()
                            ];
                        @endphp
                        <div class="group block text-left">
                            <!-- Product Image -->
                            <div class="aspect-square bg-stone-50 rounded-2xl overflow-hidden relative mb-4 flex items-center justify-center p-2">
                                <a href="{{ route('shop.show', $relProduct->slug) }}" class="w-full h-full flex items-center justify-center">
                                    <img src="{{ $relProduct->primary_image ?: '/uploads/products/samidori.jpg' }}"
                                        alt="{{ $relProduct->name }}"
                                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 {{ $isRelSoldOut ? 'opacity-60 grayscale-[30%]' : '' }}">
                                </a>

                                @if ($isRelSoldOut)
                                    <span class="absolute top-3 left-3 bg-stone-900 text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded pointer-events-none">
                                        Sold Out
                                    </span>
                                @endif

                                <!-- Floating Quick Add Button (Bottom Right) -->
                                <button type="button"
                                    onclick="openQuickAddModal({{ json_encode($relProductData) }})"
                                    class="absolute bottom-3 right-3 w-10 h-10 rounded-full bg-white text-stone-900 border border-stone-200/90 shadow-md hover:shadow-lg hover:scale-110 active:scale-95 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10"
                                    title="Quick Add {{ $relProduct->name }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-stone-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/><line x1="12" y1="13" x2="12" y2="19"/><line x1="9" y1="16" x2="15" y2="16"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Product Title -->
                            <h3 class="text-sm sm:text-base font-sans font-normal text-stone-900 group-hover:text-matcha-800 transition-colors leading-snug line-clamp-2">
                                <a href="{{ route('shop.show', $relProduct->slug) }}">
                                    {{ $relProduct->name }}
                                </a>
                            </h3>

                            <!-- Product Price -->
                            <p class="text-sm font-sans font-semibold text-stone-950 mt-1.5">
                                ₱{{ number_format($relMinPrice, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')
<script>
    function changeMainImage(src) {
        document.getElementById('main-product-image').src = src;
    }

    function incrementQty() {
        const input = document.getElementById('quantity-input');
        input.value = parseInt(input.value || 1) + 1;
    }

    function decrementQty() {
        const input = document.getElementById('quantity-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function selectVariant(btn) {
        // Remove active state from all
        document.querySelectorAll('.variant-btn').forEach(b => {
            b.classList.remove('border-matcha-700', 'bg-matcha-50/50', 'shadow-sm');
            b.classList.add('border-stone-200', 'bg-white');
        });

        // Add active state to selected
        btn.classList.remove('border-stone-200', 'bg-white');
        btn.classList.add('border-matcha-700', 'bg-matcha-50/50', 'shadow-sm');

        const variantId = btn.getAttribute('data-variant-id');
        const weight = btn.getAttribute('data-weight');
        const price = parseFloat(btn.getAttribute('data-price'));
        const compare = btn.getAttribute('data-compare');
        const isSoldOut = btn.getAttribute('data-sold-out') === '1';

        // Update hidden input
        document.getElementById('selected-variant-id').value = variantId;
        document.getElementById('selected-weight-label').innerText = weight;

        // Update price display
        document.getElementById('display-price').innerText = '₱' + price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
        const compareEl = document.getElementById('display-compare-price');
        if (compare && parseFloat(compare) > price) {
            compareEl.innerText = '₱' + parseFloat(compare).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            compareEl.classList.remove('hidden');
        } else {
            compareEl.classList.add('hidden');
        }

        // Update stock badge and button
        const badge = document.getElementById('stock-badge');
        const submitBtn = document.getElementById('add-to-cart-btn');
        const btnText = document.getElementById('btn-text');

        if (isSoldOut) {
            badge.className = 'px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-800 border border-rose-300';
            badge.innerText = 'Sold Out';
            submitBtn.disabled = true;
            submitBtn.className = 'w-full py-3.5 bg-stone-200 text-stone-400 text-xs font-bold uppercase tracking-[0.2em] rounded-lg cursor-not-allowed flex items-center justify-center gap-2';
            btnText.innerText = 'Option Sold Out';
        } else {
            badge.className = 'px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300';
            badge.innerText = 'In Stock';
            submitBtn.disabled = false;
            submitBtn.className = 'w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2';
            btnText.innerText = 'Add to Shopping Bag';
        }
    }

    // Initialize first variant
    document.addEventListener('DOMContentLoaded', function() {
        const firstBtn = document.querySelector('.variant-btn');
        if (firstBtn) {
            selectVariant(firstBtn);
        }

        // Intercept Add to Cart form submission
        const form = document.getElementById('add-to-cart-form');
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitBtn = document.getElementById('add-to-cart-btn');
                const originalContent = submitBtn.innerHTML;
                
                // Show loading indicator
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Adding to Bag...</span>
                `;

                const formData = new FormData(form);
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        // Open cart drawer and render updated items
                        if (typeof renderCartDrawer === 'function') {
                            renderCartDrawer(data);
                        }
                        if (typeof openCartDrawer === 'function') {
                            openCartDrawer();
                        }
                    } else {
                        if (typeof showToast === 'function') {
                            showToast('error', data.message || 'Unable to add item to bag.');
                        } else {
                            alert(data.message || 'Unable to add item to bag.');
                        }
                    }
                } catch (err) {
                    console.error('Add to cart failed:', err);
                    // Fallback to normal form submission if network error
                    form.submit();
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalContent;
                    lucide.createIcons();
                }
            });
        }
    });
</script>
@endsection
