@extends('layouts.app')

@section('title', 'About Us | Beyond a Cup of Coffee | Coffee Base Philippines')
@section('meta_description', 'COFFEE BASE is a specialty coffee brand founded in Kyoto, Japan. Bringing carefully selected Japanese matcha and specialty coffee to the Philippines.')

@section('content')

    <!-- ==========================================
         ABOUT HERO VIDEO BANNER (SABO STYLE)
         ========================================== -->
    <section class="relative w-full min-h-[50svh] sm:min-h-[60svh] lg:min-h-[68svh] flex flex-col justify-end overflow-hidden bg-stone-950 text-white border-b border-stone-800">
        
        <!-- Video Background with Poster Fallback -->
        <div class="absolute inset-0 z-0">
            <video class="w-full h-full object-cover opacity-85 scale-100"
                autoplay muted loop playsinline preload="auto" poster="/uploads/250509_NISHIO_132104.jpg">
                <source src="/uploads/video1.mp4" type="video/mp4">
            </video>
            <!-- Gradient Overlay Layers -->
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/45 to-stone-900/30"></div>
            <div class="absolute inset-0 bg-black/25"></div>
        </div>

        <!-- Banner Content Container -->
        <div class="relative z-10 max-w-7xl w-full mx-auto px-5 sm:px-8 lg:px-12 py-10 sm:py-14 lg:py-16">
            
            <!-- Top Band Metadata -->
            <div class="border-b border-white/20 pb-3 mb-6 flex flex-wrap items-center justify-between gap-4 font-mono text-[10px] sm:text-xs uppercase tracking-[0.25em] text-cream-200/90">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>COFFEE BASE PHILIPPINES — BEYOND A CUP OF COFFEE</span>
                </div>
                <div class="text-right text-stone-300/80">
                    <span>№ 01 / ABOUT US</span>
                </div>
            </div>

            <!-- Title & Subtitle -->
            <div class="max-w-3xl space-y-3 sm:space-y-4">
                <h1 class="text-3xl sm:text-5xl md:text-6xl font-serif font-bold tracking-[-0.03em] leading-tight text-white">
                    Beyond a Cup of Coffee.
                </h1>
                <p class="max-w-2xl text-xs sm:text-sm font-light text-cream-100/90 leading-relaxed">
                    Born in Kyoto, Japan. Bringing directly sourced single-origin Japanese matcha and artisanal roasting craft to the Philippines.
                </p>
            </div>

        </div>
    </section>

    <!-- About Content Body -->
    <div class="bg-[#fbfaf6] min-h-screen py-16 sm:py-24 border-b border-stone-200">
        <div class="max-w-4xl mx-auto px-6 sm:px-8">
            <div class="bg-white rounded-3xl border border-stone-200/90 shadow-sm p-8 sm:p-14 space-y-12 sm:space-y-16 text-stone-800">

                <!-- Section 1: Kyoto Origins & Journey -->
                <div class="space-y-4">
                    <span class="text-xs font-mono uppercase tracking-[0.25em] text-matcha-800 font-bold">01 / Our Origins</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold tracking-tight text-stone-950">
                        From the Historic Streets of Kyoto
                    </h2>
                    <p class="text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                        COFFEE BASE is a specialty coffee brand founded in Kyoto, Japan. We operate cafés and roasting bases across Japan, creating new experiences through quality, craftsmanship, and hospitality.
                    </p>
                    <p class="text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                        Our journey extends beyond coffee. We bring carefully selected Japanese matcha and specialty coffee to the Philippines, sharing the quality, terroir stories, and tea culture behind every micro-lot.
                    </p>
                </div>

                <div class="w-full h-px bg-stone-200"></div>

                <!-- Section 2: Japanese Matcha, Clearly Presented -->
                <div class="space-y-4">
                    <span class="text-xs font-mono uppercase tracking-[0.25em] text-matcha-800 font-bold">02 / Sourcing Transparency</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold tracking-tight text-stone-950">
                        Japanese Matcha, Clearly Presented
                    </h2>
                    <div class="space-y-3 text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                        <p>
                            The character of matcha is shaped by its origin, cultivar, harvest, growing method, and milling process.
                        </p>
                        <p>
                            We clearly present these details for each product, helping customers and café professionals choose the matcha that best suits their needs—from drinking straight ceremonial usucha to preparing matcha lattes and creative café beverages.
                        </p>
                    </div>
                </div>

                <div class="w-full h-px bg-stone-200"></div>

                <!-- Section 3: From Kyoto to the Philippines -->
                <div class="space-y-4">
                    <span class="text-xs font-mono uppercase tracking-[0.25em] text-matcha-800 font-bold">03 / Local Presence</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold tracking-tight text-stone-950">
                        From Kyoto to the Philippines
                    </h2>
                    <div class="space-y-3 text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                        <p>
                            After receiving an enthusiastic response at coffee and matcha events in the Philippines, we established COFFEE BASE Philippines to make our products available locally.
                        </p>
                        <p>
                            Our matcha is stocked and shipped in cold storage within the Philippines, making it easier for individuals, cafés, and businesses to access fresh, vibrant Japanese matcha without overseas customs delays.
                        </p>
                    </div>
                </div>

                <div class="w-full h-px bg-stone-200"></div>

                <!-- Section 4: Our Philosophy -->
                <div class="space-y-6">
                    <div class="p-8 sm:p-10 rounded-2xl bg-[#fbfaf6] border border-stone-200 space-y-4">
                        <span class="text-xs font-mono uppercase tracking-[0.25em] text-matcha-800 font-bold">Our Philosophy</span>
                        <h3 class="text-2xl font-serif font-bold text-stone-950 tracking-tight">
                            Craft. Hospitality. Open Mind.
                        </h3>
                        <p class="text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                            We believe that every cup can create discovery, connection, and a new sensory experience.
                        </p>
                        <div class="pt-4 border-t border-stone-200 text-stone-900 font-medium text-sm sm:text-base space-y-1">
                            <p class="font-bold">Beyond a Cup of Coffee.</p>
                            <p class="text-matcha-800 font-serif italic">From Kyoto to the world.</p>
                        </div>
                    </div>
                </div>

                <!-- Shop CTA Button -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('shop.index') }}"
                        class="px-8 py-3.5 bg-stone-950 hover:bg-matcha-900 text-white text-xs font-mono font-semibold uppercase tracking-[0.2em] rounded-xl shadow-md hover:shadow-lg transition-all">
                        Explore Our Matcha
                    </a>
                    <a href="{{ route('contact') }}"
                        class="px-8 py-3.5 border border-stone-300 hover:bg-stone-100 text-stone-900 text-xs font-mono font-semibold uppercase tracking-[0.2em] rounded-xl transition-all">
                        Contact Team
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
