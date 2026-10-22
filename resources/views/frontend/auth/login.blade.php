@extends('layouts.app')

@section('title', 'Sign In | Coffee Base Philippines')

@section('content')

    <div class="max-w-md mx-auto px-4 sm:px-6 py-16">
        <div class="bg-white rounded-2xl border border-stone-200 p-8 sm:p-10 shadow-lg">
            
            <div class="text-center mb-8">
                <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">珈琲・抹茶基地</span>
                <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950 mt-1">Welcome Back</h1>
                <p class="text-xs text-stone-500 mt-1">Sign in to track orders and manage your matcha deliveries</p>
            </div>

            @if (session('error'))
                <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-300 text-amber-950 text-xs flex items-start gap-3 shadow-xs">
                    <i data-lucide="lock" class="w-4 h-4 text-amber-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-amber-900">{{ session('error') }}</p>
                        <p class="text-[11px] text-amber-800/90 mt-0.5">Sign in to your account or create a new account to proceed with your matcha checkout.</p>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-3 shadow-xs">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Success!</p>
                        <p class="text-[11px] text-emerald-800/90 mt-0.5">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="login_email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email Address</label>
                    <input type="email" id="login_email" name="email" required value="{{ old('email') }}" placeholder="you@example.com" class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <div>
                    <label for="login_password" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Password</label>
                    <input type="password" id="login_password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <div class="flex items-center justify-between text-xs text-stone-600 pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-matcha-800 focus:ring-matcha-600">
                        <span>Remember me</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="font-semibold text-matcha-800 hover:text-matcha-950 hover:underline">
                        Forgot password?
                    </a>
                </div>

                <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all mt-4">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-stone-100 text-center text-xs text-stone-600">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}" class="font-bold text-matcha-800 hover:underline ml-1">Create Account</a>
            </div>

        </div>
    </div>

@endsection
