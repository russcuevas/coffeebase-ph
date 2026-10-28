@extends('layouts.app')

@section('title', 'Coffee Base Philippines | Artisanal Japanese Matcha & Premium Reserves')
@section('meta_description',
    'Kyoto & Nishio premium matcha and artisanal barista blends in the Philippines. Transparent
    terroir, cultivars, and stone-milled ceremonial quality.')

@section('content')

    <!-- =========================================================================
                 SECTION 1: HERO FULL-BLEED PHOTO / VIDEO WITH "OUR MATCHA" TEXT
                 ========================================================================= -->
    <section
        class="relative w-full min-h-[92svh] lg:min-h-[96svh] flex flex-col items-center justify-center overflow-hidden bg-stone-950 text-white border-b border-stone-800">

        <!-- Full-bleed background video / image -->
        <div class="absolute inset-0 z-0">
            <video class="w-full h-full object-cover opacity-90 scale-100" autoplay muted loop playsinline preload="auto"
                poster="/uploads/Nishio,%20Aichi.jpg">
                <source src="/uploads/video1.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/85 via-transparent to-black/35"></div>
        </div>

        <!-- Centered Sabo-style Editorial Overlay -->
        <div class="relative z-10 max-w-4xl mx-auto px-6 sm:px-8 py-16 text-center space-y-6 sm:space-y-8">

            <p class="text-xs font-mono uppercase tracking-[0.3em] text-cream-200/90 font-bold">
                OUR MATCHA
            </p>

            <h1 class="text-3xl sm:text-5xl md:text-6xl font-serif font-bold tracking-[-0.03em] leading-tight text-white">
                Quality starts at the tea garden.
            </h1>

            <div class="max-w-2xl mx-auto text-xs sm:text-sm md:text-base font-light text-cream-100/90 leading-relaxed">
                <p>
                    The flavour and character of matcha depend on its origin, cultivar, shading, harvest, and processing. We
                    carefully select our matcha from trusted tea-growing regions in Japan, including Uji, Nishio, Yame,
                    Kagoshima, and Shizuoka.
                </p>
            </div>

            <!-- Regional Badges -->
            <div
                class="pt-2 flex flex-wrap items-center justify-center gap-2 sm:gap-3 font-mono text-[10px] sm:text-[11px] uppercase tracking-wider text-cream-100">
                <span class="px-3.5 py-1.5 bg-white/15 backdrop-blur-md rounded-full border border-white/25">Uji (宇治)</span>
                <span class="px-3.5 py-1.5 bg-white/15 backdrop-blur-md rounded-full border border-white/25">Nishio
                    (西尾)</span>
                <span class="px-3.5 py-1.5 bg-white/15 backdrop-blur-md rounded-full border border-white/25">Yame
                    (八女)</span>
                <span class="px-3.5 py-1.5 bg-white/15 backdrop-blur-md rounded-full border border-white/25">Kagoshima
                    (鹿児島)</span>
                <span class="px-3.5 py-1.5 bg-white/15 backdrop-blur-md rounded-full border border-white/25">Shizuoka
                    (静岡)</span>
            </div>

            <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('shop.index', ['category' => 'premium']) }}"
                    class="px-8 py-3.5 bg-white text-stone-950 hover:bg-cream-200 text-xs font-mono font-semibold uppercase tracking-[0.2em] transition-all shadow-lg hover:shadow-xl">
                    Explore Premium
                </a>
                <a href="{{ route('shop.index', ['category' => 'barista']) }}"
                    class="px-8 py-3.5 border border-white/70 text-white hover:bg-white/15 backdrop-blur-xs text-xs font-mono font-semibold uppercase tracking-[0.2em] transition-all">
                    Discover Barista
                </a>
            </div>

            <div class="pt-4">
                <span class="inline-block text-[10px] font-mono uppercase tracking-[0.25em] text-white/60">
                    Scroll Down &darr;
                </span>
            </div>
        </div>
    </section>

    <!-- =========================================================================
                 SECTION 2: FULL-WIDTH EDITORIAL PHOTO 1 (NISHIO TEA GARDEN CANOPY)
                 ========================================================================= -->
    <div class="w-full overflow-hidden bg-stone-950 border-b border-stone-200">
        <div class="w-full aspect-[16/10] sm:aspect-[21/9] lg:aspect-[2.4/1] relative">
            <img src="/uploads/250509_NISHIO_132104.jpg" alt="Nishio Shaded Tea Farm Plantation"
                class="w-full h-full object-cover object-center">
            <div
                class="absolute bottom-4 left-6 sm:left-12 text-[10px] sm:text-xs font-mono uppercase tracking-[0.25em] text-white/90 bg-black/50 backdrop-blur-md px-3 py-1.5 rounded">
                01 / Nishio, Aichi Prefecture — Shaded Tencha Canopy
            </div>
        </div>
    </div>

    <!-- =========================================================================
                 SECTION 3: GRADES (EDITORIAL TEXT & 2-COLUMN CLASSIFICATION)
                 ========================================================================= -->
    <section class="py-20 sm:py-28 bg-white border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

            <div class="text-center max-w-2xl mx-auto mb-14 sm:mb-20 space-y-3">
                <p class="text-xs font-mono uppercase tracking-[0.3em] text-matcha-800 font-bold">
                    GRADES
                </p>
                <h2 class="text-3xl sm:text-5xl font-serif font-bold tracking-tight text-stone-950">
                    Understanding Our Matcha Grades
                </h2>
                <p class="text-xs sm:text-sm text-stone-600 font-light">
                    Clear transparency on harvest flush, flavor character, and intended preparation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-14 max-w-5xl mx-auto">

                <!-- PREMIUM Card -->
                <div
                    class="bg-[#fbfaf6] border border-stone-200 rounded-2xl p-8 sm:p-12 space-y-6 flex flex-col justify-between hover:border-stone-400 transition-all duration-300 hover:shadow-xl">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-stone-200 pb-4">
                            <span
                                class="text-[10px] font-mono uppercase tracking-[0.2em] px-3 py-1 bg-stone-950 text-white rounded font-semibold">
                                First-Flush Leaves
                            </span>
                            <span class="text-xs font-mono text-stone-500">№ 01</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-serif font-bold tracking-tight text-stone-950">
                            PREMIUM
                        </h3>
                        <p class="text-xs sm:text-sm md:text-base text-stone-700 font-light leading-relaxed">
                            Made from first-flush leaves, carefully selected for a smooth, vibrant and naturally rich
                            flavour. Enjoy it straight or use it for premium matcha drinks.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-stone-200 flex items-center justify-between font-mono text-xs">
                        <span class="text-stone-500 uppercase tracking-wider text-[11px]">Usucha • Straight • Cold
                            Whisk</span>
                    </div>
                </div>

                <!-- BARISTA Card -->
                <div
                    class="bg-[#fbfaf6] border border-stone-200 rounded-2xl p-8 sm:p-12 space-y-6 flex flex-col justify-between hover:border-stone-400 transition-all duration-300 hover:shadow-xl">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-stone-200 pb-4">
                            <span
                                class="text-[10px] font-mono uppercase tracking-[0.2em] px-3 py-1 bg-stone-950 text-white rounded font-semibold">
                                First &amp; Second Flush Blend
                            </span>
                            <span class="text-xs font-mono text-stone-500">№ 02</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-serif font-bold tracking-tight text-stone-950">
                            BARISTA
                        </h3>
                        <p class="text-xs sm:text-sm md:text-base text-stone-700 font-light leading-relaxed">
                            A carefully balanced blend of first- and second-flush leaves, offering great flavour at a more
                            approachable price. Ideal for lattes, milk-based drinks and creative beverages.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-stone-200 flex items-center justify-between font-mono text-xs">
                        <span class="text-stone-500 uppercase tracking-wider text-[11px]">Lattes • Plant Milk •
                            Pastry</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================================
                 SECTION 4: FULL-WIDTH EDITORIAL PHOTO 2 (KOKAEN STONE MILLING & PROCESSING)
                 ========================================================================= -->
    <div class="w-full overflow-hidden bg-stone-950 border-b border-stone-200">
        <div class="w-full aspect-[16/10] sm:aspect-[21/9] lg:aspect-[2.4/1] relative">
            <img src="/uploads/260417_KOKAEN_133240.jpg" alt="Traditional Japanese Tea Finishing and Stone Mill Facility"
                class="w-full h-full object-cover object-center">
            <div
                class="absolute bottom-4 left-6 sm:left-12 text-[10px] sm:text-xs font-mono uppercase tracking-[0.25em] text-white/90 bg-black/50 backdrop-blur-md px-3 py-1.5 rounded">
                02 / Kokaen, Kyoto — Artisanal Finishing &amp; Sorting
            </div>
        </div>
    </div>

    <!-- =========================================================================
                 SECTION 5: CURATED COLLECTIONS (PREMIUM & BARISTA)
                 ========================================================================= -->
    <section class="py-20 sm:py-28 bg-[#fbfaf6] border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

            <div class="max-w-3xl mb-14 sm:mb-20 space-y-3">
                <p class="text-xs font-mono uppercase tracking-[0.3em] text-matcha-800 font-bold">Collections</p>
                <h2 class="text-3xl sm:text-5xl font-serif font-bold tracking-tight text-stone-950">
                    Singles Origin &amp; Master Blends
                </h2>
                <p class="text-xs sm:text-sm text-stone-600 font-light leading-relaxed">
                    Explore single cultivar nuance or perfectly calibrated blends for beverage craft.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                <!-- Card 1: Singles Origin -->
                <a href="{{ route('shop.index', ['category' => 'single-origin-matcha']) }}"
                    class="group block bg-white border border-stone-200 rounded-2xl overflow-hidden hover:border-stone-400 transition-all duration-500 hover:shadow-2xl">
                    <div class="aspect-[16/10] overflow-hidden relative bg-stone-100">
                        <img src="/uploads/Nishio,%20Aichi.jpg" alt="Singles Origin Matcha"
                            class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                        <span
                            class="absolute top-4 left-4 px-3 py-1 bg-white/95 backdrop-blur-xs text-stone-950 font-mono text-[10px] uppercase tracking-[0.2em] font-bold rounded">
                            № 01 / Single Cultivars
                        </span>
                    </div>
                    <div class="p-6 sm:p-10 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3
                                class="text-2xl font-serif font-bold text-stone-950 group-hover:text-matcha-800 transition-colors">
                                Singles Origin Matcha
                            </h3>
                            <span
                                class="w-9 h-9 rounded-full bg-stone-100 flex items-center justify-center text-stone-800 group-hover:bg-stone-950 group-hover:text-white transition-all">
                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-stone-600 font-light leading-relaxed">
                            Unblended single-cultivar micro-lots capturing pure terroir nuance from Nishio and Kagoshima
                            (Samidori, Okumidori, Yabukita).
                        </p>
                    </div>
                </a>

                <!-- Card 2: Matcha Blends -->
                <a href="{{ route('shop.index', ['category' => 'matcha-blends']) }}"
                    class="group block bg-white border border-stone-200 rounded-2xl overflow-hidden hover:border-stone-400 transition-all duration-500 hover:shadow-2xl">
                    <div class="aspect-[16/10] overflow-hidden relative bg-stone-100">
                        <img src="/uploads/KAGOSHIMA.jpg" alt="Matcha Blends"
                            class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                        <span
                            class="absolute top-4 left-4 px-3 py-1 bg-white/95 backdrop-blur-xs text-stone-950 font-mono text-[10px] uppercase tracking-[0.2em] font-bold rounded">
                            № 02 / Master Blends
                        </span>
                    </div>
                    <div class="p-6 sm:p-10 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3
                                class="text-2xl font-serif font-bold text-stone-950 group-hover:text-matcha-800 transition-colors">
                                Matcha Blends
                            </h3>
                            <span
                                class="w-9 h-9 rounded-full bg-stone-100 flex items-center justify-center text-stone-800 group-hover:bg-stone-950 group-hover:text-white transition-all">
                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-stone-600 font-light leading-relaxed">
                            Formulated by tea masters combining multiple harvests to achieve rich body, deep color, and
                            smooth sweetness in milk lattes and beverages.
                        </p>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- =========================================================================
                 SECTION 6: FULL-WIDTH EDITORIAL PHOTO 3 (KAGOSHIMA VOLCANIC FIELDS)
                 ========================================================================= -->
    <div class="w-full overflow-hidden bg-stone-950 border-b border-stone-200">
        <div class="w-full aspect-[16/10] sm:aspect-[21/9] lg:aspect-[2.4/1] relative">
            <img src="/uploads/260422_KAGOSHIMA_094548.jpg" alt="Kagoshima Organic Volcanic Tea Garden"
                class="w-full h-full object-cover object-center">
            <div
                class="absolute bottom-4 left-6 sm:left-12 text-[10px] sm:text-xs font-mono uppercase tracking-[0.25em] text-white/90 bg-black/50 backdrop-blur-md px-3 py-1.5 rounded">
                03 / Kagoshima Terroir — Volcanic Mineral Soil &amp; Abundant Sunshine
            </div>
        </div>
    </div>

    <!-- =========================================================================
                 SECTION 7: FULL-WIDTH CINEMATIC CRAFT VIDEO (WHISKING & STONE MILLING)
                 ========================================================================= -->
    <div class="w-full overflow-hidden bg-stone-950 border-b border-stone-200">
        <div class="w-full aspect-[16/10] sm:aspect-[21/9] lg:aspect-[2.4/1] relative">
            <video class="w-full h-full object-cover" autoplay muted loop playsinline preload="auto">
                <source src="/uploads/video2.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
            <div
                class="absolute bottom-4 left-6 sm:left-12 text-[10px] sm:text-xs font-mono uppercase tracking-[0.25em] text-white/90 bg-black/50 backdrop-blur-md px-3 py-1.5 rounded">
                04 / Granite Stone-Milled at 30g/hr &amp; Traditional Chasen Whisk
            </div>
        </div>
    </div>

    <!-- =========================================================================
                 SECTION 8: BIR REGISTRATION & COMPLIANCE SEAL
                 ========================================================================= -->
    <section class="py-12 sm:py-16 bg-[#fbfaf6] border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 text-center flex flex-col items-center justify-center space-y-4">
            <p class="text-[10px] sm:text-xs font-mono uppercase tracking-[0.25em] text-stone-500">
                Official Business Registration &amp; Compliance
            </p>
            <div
                class="inline-block p-4 sm:p-6 md:p-8 bg-white rounded-3xl border border-stone-200 shadow-md max-w-3xl w-full">
                <img src="{{ asset('uploads/bir-seal.jpg') }}" alt="BIR Registered Notice - Bureau of Internal Revenue"
                    class="w-full h-auto object-contain mx-auto rounded-xl">
            </div>
            <p class="text-[11px] font-mono text-stone-400">
                Registered with the Bureau of Internal Revenue (BIR Philippines)
            </p>
        </div>
    </section>

@endsection
