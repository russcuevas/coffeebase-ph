@extends('layouts.app')

@section('title', 'Track Your Matcha Order | Coffee Base Philippines')

@section('content')

    <div class="bg-cream-100/70 border-b border-cream-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">Live Status & Dispatch Updates</span>
            <h1 class="text-3xl sm:text-5xl font-sans font-bold tracking-tight text-matcha-950 mt-1">Track Your Order</h1>
            <p class="text-xs sm:text-sm text-stone-600 mt-2 max-w-lg mx-auto font-light">
                Enter your Coffee Base reference number (e.g. <span class="font-mono font-semibold text-matcha-900">CB-20261001-XXXX</span>) to check preparation status and view your live courier tracking link.
            </p>
        </div>
    </div>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl border border-stone-200 p-8 shadow-md">
            
            <form action="{{ route('orders.track.search') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="order_number" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Order Reference Number</label>
                    <div class="relative">
                        <input type="text" id="order_number" name="order_number" required value="{{ old('order_number') }}" placeholder="e.g. CB-20261001-1003" class="w-full pl-10 pr-4 py-3.5 rounded-xl border border-stone-300 text-sm uppercase tracking-wider font-mono focus:ring-2 focus:ring-matcha-600 outline-none">
                        <i data-lucide="package-search" class="w-5 h-5 text-stone-400 absolute left-3.5 top-3.5"></i>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <i data-lucide="compass" class="w-4 h-4"></i>
                    <span>Track Order Status</span>
                </button>
            </form>

            @auth
                <div class="mt-6 pt-6 border-t border-stone-100 text-center">
                    <a href="{{ route('orders.my_orders') }}" class="text-xs text-matcha-800 font-semibold hover:underline">
                        Or view your complete Order History →
                    </a>
                </div>
            @endauth

        </div>
    </div>

@endsection
