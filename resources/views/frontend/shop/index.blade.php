@extends('layouts.app')

@section('title', 'Matcha Catalog & Single Origin Reserves | Coffee Base Philippines')
@section('meta_description', 'Directly imported single-origin cultivars and artisanal matcha blends from Nishio, Kagoshima, and Uji. Available for retail and wholesale in the Philippines.')

@section('content')

    <!-- ==========================================
         SHOP HERO VIDEO BANNER (SABO WHOLESALE STYLE)
         ========================================== -->
    <section class="relative w-full min-h-[55svh] sm:min-h-[65svh] lg:min-h-[72svh] flex flex-col justify-end overflow-hidden bg-stone-950 text-white border-b border-stone-800">
        
        <!-- Background Video with Poster Fallback -->
        <div class="absolute inset-0 z-0">
            <video class="w-full h-full object-cover opacity-85 scale-100"
                autoplay muted loop playsinline preload="auto" poster="/uploads/KAGOSHIMA.jpg">
                <source src="/uploads/video3.mp4" type="video/mp4">
            </video>
            <!-- Gradient Overlay Layers (Wholesale Sabo Style) -->
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/45 to-stone-900/30"></div>
            <div class="absolute inset-0 bg-black/25"></div>
        </div>

        <!-- Banner Content Container -->
        <div class="relative z-10 max-w-7xl w-full mx-auto px-5 sm:px-8 lg:px-12 py-10 sm:py-14 lg:py-16">
            
            <!-- Top Band Metadata -->
            <div class="border-b border-white/20 pb-3 mb-6 flex flex-wrap items-center justify-between gap-4 font-mono text-[10px] sm:text-xs uppercase tracking-[0.25em] text-cream-200/90">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>COFFEE BASE CATALOG — BEING FOR THE MATCHA CULTURE</span>
                </div>
                <div class="text-right text-stone-300/80">
                    <span>№ 01 / PHILIPPINES &amp; JAPAN</span>
                </div>
            </div>

            <!-- Title & Subtitle Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-end">
                <div class="lg:col-span-8 space-y-3 sm:space-y-4">
                    <h1 class="text-3xl sm:text-5xl md:text-6xl font-serif font-bold tracking-[-0.03em] leading-tight text-white">
                        Matcha Catalog
                    </h1>
                    <p class="max-w-2xl text-xs sm:text-sm font-light text-cream-100/90 leading-relaxed">
                        Directly imported Japanese tencha, stone-milled to order. Explore pure single cultivars for ceremonial usucha, and artisanal master blends crafted for rich barista lattes and pastry.
                    </p>
                </div>

                <!-- Quick Category Selector on Banner -->
                <div class="lg:col-span-4 flex flex-wrap gap-2 lg:justify-end">
                    <a href="{{ route('shop.index') }}"
                        class="px-4 py-2 text-[11px] font-mono uppercase tracking-[0.15em] transition-all {{ !request('category') && !request('grade') ? 'bg-white text-stone-950 font-bold' : 'bg-black/40 text-cream-100 border border-white/40 hover:bg-white/20' }}">
                        All Matcha
                    </a>
                    <a href="{{ route('shop.index', ['category' => 'single-origin-matcha']) }}"
                        class="px-4 py-2 text-[11px] font-mono uppercase tracking-[0.15em] transition-all {{ request('category') === 'single-origin-matcha' || request('category') === 'singles-origin' || request('category') === 'single-origin' ? 'bg-white text-stone-950 font-bold' : 'bg-black/40 text-cream-100 border border-white/40 hover:bg-white/20' }}">
                        Singles Origin
                    </a>
                    <a href="{{ route('shop.index', ['category' => 'matcha-blends']) }}"
                        class="px-4 py-2 text-[11px] font-mono uppercase tracking-[0.15em] transition-all {{ request('category') === 'matcha-blends' ? 'bg-white text-stone-950 font-bold' : 'bg-black/40 text-cream-100 border border-white/40 hover:bg-white/20' }}">
                        Matcha Blends
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ==========================================
         MAIN CATALOG PRODUCTS & CONTROLS
         ========================================== -->
    <div class="bg-[#fbfaf6] min-h-screen py-10 sm:py-16 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            
            <!-- Filter & Search Controls Bar -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-stone-200 shadow-xs mb-10 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                
                <!-- Category Tabs -->
                <div class="flex flex-wrap items-center gap-2 font-mono text-xs uppercase tracking-wider">
                    <a href="{{ route('shop.index') }}"
                        class="px-4 py-2.5 rounded-xl transition-all {{ !request('category') && !request('grade') ? 'bg-stone-950 text-white font-semibold shadow-xs' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                        All ({{ $products->total() }})
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('shop.index', ['category' => $cat->slug, 'search' => request('search')]) }}"
                            class="px-4 py-2.5 rounded-xl transition-all {{ request('category') === $cat->slug ? 'bg-stone-950 text-white font-semibold shadow-xs' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Search and Sort Form -->
                <form action="{{ route('shop.index') }}" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('grade'))
                        <input type="hidden" name="grade" value="{{ request('grade') }}">
                    @endif

                    <div class="relative flex-1 sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search cultivar, origin, grade..."
                            class="w-full pl-9 pr-4 py-2.5 text-xs rounded-xl border border-stone-300 focus:ring-2 focus:ring-matcha-700 outline-none bg-stone-50/50 focus:bg-white transition-all">
                        <i data-lucide="search" class="w-4 h-4 text-stone-400 absolute left-3 top-3"></i>
                    </div>

                    <select name="sort" onchange="this.form.submit()"
                        class="text-xs font-mono uppercase tracking-wider border border-stone-300 rounded-xl px-3.5 py-2.5 bg-white text-stone-700 focus:ring-2 focus:ring-matcha-700 outline-none">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Releases</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>

                    <button type="submit" class="px-4 py-2.5 bg-stone-950 text-white rounded-xl text-xs font-mono uppercase tracking-wider hover:bg-matcha-900 transition-colors">
                        Filter
                    </button>
                </form>

            </div>

            <!-- Products Grid -->
            @if($products->isEmpty())
                <div class="text-center py-24 bg-white rounded-3xl border border-stone-200 p-8 max-w-lg mx-auto shadow-xs">
                    <i data-lucide="leaf" class="w-12 h-12 text-matcha-600 mx-auto mb-4"></i>
                    <h3 class="text-xl font-serif font-bold text-stone-900">No Matcha Matches Found</h3>
                    <p class="text-xs text-stone-500 mt-2 font-light">Try adjusting your category filter or search keyword.</p>
                    <a href="{{ route('shop.index') }}" class="inline-block mt-5 px-6 py-2.5 bg-stone-950 text-white font-mono text-xs uppercase tracking-wider rounded-xl hover:bg-stone-800 transition-colors">
                        Reset All Filters
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-5 sm:gap-x-8 gap-y-12">
                    @foreach($products as $product)
                        @php
                            $isSoldOut = $product->is_sold_out;
                            $minPrice = $product->min_price;
                            $productData = [
                                'id' => $product->id,
                                'name' => $product->name,
                                'slug' => $product->slug,
                                'image' => $product->primary_image ?: '/uploads/products/samidori.jpg',
                                'variants' => $product->variants->map(fn($v) => [
                                    'id' => $v->id,
                                    'weight' => $v->weight,
                                    'price' => (float)$v->price,
                                    'compare_at_price' => $v->compare_at_price ? (float)$v->compare_at_price : null,
                                    'is_sold_out' => (bool)($v->is_sold_out || $v->stock_quantity <= 0),
                                ])->values()
                            ];
                        @endphp
                        <div class="group block text-left bg-white p-3.5 sm:p-4 rounded-2xl border border-stone-200/80 hover:border-stone-400 hover:shadow-lg transition-all duration-300">
                            
                            <!-- Product Image -->
                            <div class="aspect-square bg-stone-50 rounded-xl overflow-hidden relative mb-4 flex items-center justify-center p-2">
                                <a href="{{ route('shop.show', $product->slug) }}" class="w-full h-full flex items-center justify-center">
                                    <img src="{{ $product->primary_image ?: '/uploads/products/samidori.jpg' }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 {{ $isSoldOut ? 'opacity-60 grayscale-[30%]' : '' }}">
                                </a>

                                @if ($isSoldOut)
                                    <span class="absolute top-2.5 left-2.5 bg-stone-900 text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2 py-0.5 rounded">
                                        Sold Out
                                    </span>
                                @elseif($product->category)
                                    <span class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[9px] font-mono uppercase tracking-wider px-2 py-0.5 rounded border border-stone-200">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                                @if($product->has_bulk_discount && !$isSoldOut)
                                    <span class="absolute top-2.5 right-2.5 bg-amber-500/90 backdrop-blur-xs text-stone-950 text-[8.5px] font-mono font-bold uppercase tracking-wider px-2 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                        <i data-lucide="percent" class="w-2.5 h-2.5"></i>
                                        <span>Bulk: Up to {{ $product->max_bulk_discount_percent }}% OFF</span>
                                    </span>
                                @endif

                                <!-- Quick Add Button -->
                                <button type="button"
                                    onclick="openQuickAddModal({{ json_encode($productData) }})"
                                    class="absolute bottom-2.5 right-2.5 w-10 h-10 rounded-full bg-white text-stone-900 border border-stone-300 shadow-md hover:shadow-xl hover:scale-110 active:scale-95 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10 hover:bg-stone-900 hover:text-white"
                                    title="Quick Add {{ $product->name }}">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                </button>
                            </div>

                            <!-- Product Details -->
                            <div class="space-y-1.5">
                                <p class="text-[10px] font-mono uppercase tracking-[0.15em] text-stone-500">
                                    {{ $product->origin ?? 'Kyoto / Aichi, Japan' }}
                                </p>
                                <h3 class="text-sm sm:text-base font-serif font-bold text-stone-950 group-hover:text-matcha-800 transition-colors leading-snug line-clamp-2">
                                    <a href="{{ route('shop.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between pt-1">
                                    <p class="text-xs sm:text-sm font-mono font-semibold text-stone-950">
                                        ₱{{ number_format($minPrice, 2) }}
                                    </p>
                                    @if($product->grade)
                                        <span class="text-[9px] font-mono uppercase tracking-wider text-matcha-700 bg-matcha-50 px-2 py-0.5 rounded">
                                            {{ $product->grade }}
                                        </span>
                                    @endif
                                </div>

                                @if($product->has_bulk_discount)
                                    <div class="pt-1 border-t border-stone-100 flex items-center gap-1.5 text-[10px] text-amber-900 font-mono">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span class="truncate">{{ $product->sorted_bulk_discounts[0]['label'] ?? 'Bulk discount available' }}</span>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-14 flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection
