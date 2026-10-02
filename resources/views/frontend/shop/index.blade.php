@extends('layouts.app')

@section('title', 'Matcha Catalog & Single Origin Reserve | Coffee Base Philippines')
@section('meta_description', 'Browse our complete catalog of ceremonial grade, barista blend, and single cultivar Japanese matcha from Uji, Kyoto and Yame, Fukuoka.')

@section('content')

    <!-- Catalog Banner -->
    <div class="bg-cream-100 border-b border-cream-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">Single Origin • Kyoto & Fukuoka</span>
                <h1 class="text-3xl sm:text-5xl font-sans font-bold tracking-tight text-matcha-950 mt-1">Our Matcha Catalog</h1>
                <p class="text-xs sm:text-sm text-stone-600 mt-3 font-light">
                    Directly imported tencha, stone-milled to order. Filter by ceremonial grade, daily blends, or bulk 1kg packs.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Shop Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Filter & Search Controls Bar -->
        <div class="bg-white rounded-xl p-4 border border-stone-200 shadow-sm mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            
            <!-- Category Pills -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('shop.index') }}" class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all {{ !request('category') && !request('grade') ? 'bg-matcha-800 text-white shadow-sm' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                    All Matcha
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('shop.index', ['category' => $cat->slug, 'search' => request('search')]) }}" class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all {{ request('category') === $cat->slug ? 'bg-matcha-800 text-white shadow-sm' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- Search and Sort -->
            <form action="{{ route('shop.index') }}" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('grade'))
                    <input type="hidden" name="grade" value="{{ request('grade') }}">
                @endif

                <div class="relative flex-1 sm:w-60">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search matcha, cultivar, origin..." class="w-full pl-9 pr-4 py-2 text-xs rounded-lg border border-stone-300 focus:ring-2 focus:ring-matcha-600 outline-none">
                    <i data-lucide="search" class="w-4 h-4 text-stone-400 absolute left-3 top-2.5"></i>
                </div>

                <select name="sort" onchange="this.form.submit()" class="text-xs border border-stone-300 rounded-lg px-3 py-2 bg-white text-stone-700 focus:ring-2 focus:ring-matcha-600 outline-none">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Releases</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>

                <button type="submit" class="px-3.5 py-2 bg-matcha-700 text-white rounded-lg text-xs font-semibold uppercase hover:bg-matcha-800 transition-colors">
                    Filter
                </button>
            </form>

        </div>

        <!-- Products Grid -->
        @if($products->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-stone-200 p-8">
                <i data-lucide="leaf" class="w-12 h-12 text-matcha-400 mx-auto mb-4"></i>
                <h3 class="text-xl font-sans font-bold tracking-tight text-stone-800">No Matcha Found</h3>
                <p class="text-xs text-stone-500 mt-2">Try adjusting your filters or search keyword.</p>
                <a href="{{ route('shop.index') }}" class="inline-block mt-4 px-6 py-2.5 bg-matcha-800 text-cream-50 text-xs font-semibold uppercase tracking-wider rounded-lg">
                    Reset All Filters
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-12">
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
                    <div class="group block text-left">
                        <!-- Product Image -->
                        <div class="aspect-square bg-stone-50 rounded-2xl overflow-hidden relative mb-4 flex items-center justify-center p-2">
                            <a href="{{ route('shop.show', $product->slug) }}" class="w-full h-full flex items-center justify-center">
                                <img src="{{ $product->primary_image ?: '/uploads/products/samidori.jpg' }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 {{ $isSoldOut ? 'opacity-60 grayscale-[30%]' : '' }}">
                            </a>

                            @if ($isSoldOut)
                                <span class="absolute top-3 left-3 bg-stone-900 text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded pointer-events-none">
                                    Sold Out
                                </span>
                            @endif

                            <!-- Floating Quick Add Button (Bottom Right) -->
                            <button type="button"
                                onclick="openQuickAddModal({{ json_encode($productData) }})"
                                class="absolute bottom-3 right-3 w-10 h-10 rounded-full bg-white text-stone-900 border border-stone-200/90 shadow-md hover:shadow-lg hover:scale-110 active:scale-95 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10"
                                title="Quick Add {{ $product->name }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-stone-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/><line x1="12" y1="13" x2="12" y2="19"/><line x1="9" y1="16" x2="15" y2="16"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Product Title -->
                        <h3 class="text-sm sm:text-base font-sans font-normal text-stone-900 group-hover:text-matcha-800 transition-colors leading-snug line-clamp-2">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <!-- Product Price -->
                        <p class="text-sm font-sans font-semibold text-stone-950 mt-1.5">
                            ₱{{ number_format($minPrice, 2) }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif

    </div>

@endsection
