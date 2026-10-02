@extends('layouts.app')

@section('title', 'About Us | Beyond a Cup of Coffee | Coffee Base Philippines')
@section('meta_description', 'COFFEE BASE is a specialty coffee brand founded in Kyoto, Japan. Bringing carefully selected Japanese matcha and specialty coffee to the Philippines.')

@section('content')

    <!-- About Hero Header -->
    <div class="bg-cream-100/70 border-b border-cream-300/80 py-16 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">About Us</span>
            <h1 class="text-3xl sm:text-5xl font-sans font-bold tracking-tight text-matcha-950 mt-2">
                Beyond a Cup of Coffee.
            </h1>
        </div>
    </div>

    <!-- About Content Body -->
    <div class="max-w-3xl mx-auto px-6 sm:px-8 py-16 sm:py-24">
        <div class="space-y-16 text-stone-800">

            <!-- Section 1: Kyoto Origins & Journey -->
            <div class="space-y-6">
                <p class="text-base sm:text-lg text-stone-900 leading-relaxed font-normal">
                    COFFEE BASE is a specialty coffee brand founded in Kyoto, Japan. We operate cafés and roasting bases across Japan, creating new experiences through quality, craftsmanship and hospitality.
                </p>
                <p class="text-base sm:text-lg text-stone-900 leading-relaxed font-normal">
                    Our journey now extends beyond coffee.
                </p>
                <p class="text-base sm:text-lg text-stone-900 leading-relaxed font-normal">
                    We bring carefully selected Japanese matcha and specialty coffee to the Philippines, sharing the quality, stories and culture behind every product.
                </p>
            </div>

            <div class="w-16 h-px bg-stone-300"></div>

            <!-- Section 2: Japanese Matcha, Clearly Presented -->
            <div class="space-y-4">
                <h2 class="text-2xl sm:text-3xl font-sans font-bold tracking-tight text-stone-950">
                    Japanese Matcha, Clearly Presented
                </h2>
                <div class="space-y-4 text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                    <p>
                        The character of matcha is shaped by its origin, cultivar, harvest, growing method and milling process.
                    </p>
                    <p>
                        We clearly present these details for each product, helping customers and café professionals choose the matcha that best suits their needs—from drinking straight to preparing matcha lattes and creative café beverages.
                    </p>
                </div>
            </div>

            <div class="w-16 h-px bg-stone-300"></div>

            <!-- Section 3: From Kyoto to the Philippines -->
            <div class="space-y-4">
                <h2 class="text-2xl sm:text-3xl font-sans font-bold tracking-tight text-stone-950">
                    From Kyoto to the Philippines
                </h2>
                <div class="space-y-4 text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                    <p>
                        After receiving an enthusiastic response at coffee and matcha events in the Philippines, we established COFFEE BASE Philippines to make our products available locally.
                    </p>
                    <p>
                        Our matcha is stocked and shipped within the Philippines, making it easier for individuals, cafés and businesses to access quality Japanese matcha.
                    </p>
                </div>
            </div>

            <div class="w-16 h-px bg-stone-300"></div>

            <!-- Section 4: Our Philosophy -->
            <div class="space-y-6">
                <h2 class="text-2xl sm:text-3xl font-sans font-bold tracking-tight text-stone-950">
                    Our Philosophy
                </h2>
                <div class="p-8 rounded-2xl bg-cream-100/60 border border-stone-200 space-y-4">
                    <h3 class="text-xl font-sans font-bold text-matcha-900 tracking-tight">
                        Craft. Hospitality. Open Mind.
                    </h3>
                    <p class="text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                        We believe that every cup can create discovery, connection and a new experience.
                    </p>
                    <div class="pt-4 border-t border-stone-200/80 text-stone-900 font-medium text-sm sm:text-base space-y-1">
                        <p class="font-bold">Beyond a Cup of Coffee.</p>
                        <p class="text-matcha-800">From Kyoto to the world.</p>
                    </div>
                </div>
            </div>

            <!-- Shop CTA Button -->
            <div class="pt-8 text-center sm:text-left">
                <a href="{{ route('shop.index') }}"
                    class="inline-block px-8 py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-xl shadow-md hover:shadow-lg transition-all">
                    Explore Our Matcha
                </a>
            </div>

        </div>
    </div>

@endsection
