@extends('layouts.app')

@section('title', 'Coffee Base Philippines | Japanese Artisanal Matcha & Single Origin Reserves')

@section('content')

    <!-- Hero Banner Section -->
    <section
        class="relative w-full min-h-[420px] sm:min-h-[480px] lg:min-h-[540px] flex items-center justify-center overflow-hidden bg-stone-950 border-b border-cream-300/40">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="/uploads/banner.jpg" alt="Japanese Matcha & Specialty Coffee, Selected by COFFEE BASE."
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <!-- Centered Content -->
        <div class="relative z-10 max-w-5xl mx-auto px-6 sm:px-8 py-20 text-center text-white space-y-8">
            <h1
                class="text-2xl sm:text-4xl md:text-5xl lg:text-[46px] font-sans font-bold tracking-tight text-white leading-tight drop-shadow-md">
                Japanese Matcha &amp; Specialty Coffee, Selected by COFFEE BASE.
            </h1>

            <div>
                <a href="{{ route('shop.index') }}"
                    class="inline-block px-8 py-3 rounded-xl border border-white/80 text-white text-xs sm:text-sm font-sans font-medium tracking-wide bg-stone-900/60 hover:bg-white hover:text-stone-950 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-lg">
                    Shop Matcha
                </a>
            </div>
        </div>
    </section>



    <!-- Featured Products Showcase -->
    <section class="py-20 bg-white border-b border-stone-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-2xl sm:text-3xl font-sans font-bold tracking-tight text-stone-950">Featured Products</h2>
                <a href="{{ route('shop.index') }}"
                    class="text-xs font-semibold uppercase tracking-widest text-stone-700 hover:text-stone-950 flex items-center gap-1 group">
                    <span>View All</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-12">
                @foreach ($featuredProducts as $product)
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
        </div>
    </section>

    <!-- From Kyoto to the Philippines Section -->
    <section id="about" class="py-24 sm:py-32 bg-white text-center">
        <div class="max-w-4xl mx-auto px-6 sm:px-8 space-y-8">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-sans font-bold tracking-tight text-stone-950">
                From Kyoto to the Philippines
            </h2>
            <div class="max-w-2xl mx-auto space-y-6 text-xs sm:text-sm text-stone-700 leading-relaxed font-light">
                <p>
                    COFFEE BASE is a Kyoto-born specialty coffee brand bringing carefully selected Japanese matcha and specialty coffee to the Philippines.
                </p>
                <p>
                    We clearly present each matcha's origin, cultivar, harvest, milling method and grade, helping you choose the right matcha for your cup or café.
                </p>
            </div>
        </div>
    </section>

@endsection
