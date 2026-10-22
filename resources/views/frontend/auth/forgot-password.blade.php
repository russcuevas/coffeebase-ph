@extends('layouts.app')

@section('title', 'Forgot Password | Coffee Base Philippines')

@section('content')

    <div class="max-w-md mx-auto px-4 sm:px-6 py-16">
        <div class="bg-white rounded-2xl border border-stone-200 p-8 sm:p-10 shadow-lg">
            
            <div class="text-center mb-8">
                <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">珈琲・抹茶基地</span>
                <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950 mt-1">Forgot Password</h1>
                <p class="text-xs text-stone-500 mt-1">Enter your registered email address to receive a secure password reset link.</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-3 shadow-xs">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Email Sent!</p>
                        <p class="text-[11px] text-emerald-800/90 mt-0.5">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-start gap-3 shadow-xs">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-rose-950">Please check the errors:</p>
                        <ul class="list-disc list-inside text-[11px] text-rose-800/90 mt-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reset_email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email Address</label>
                    <input type="email" id="reset_email" name="email" required value="{{ old('email') }}" placeholder="you@example.com" class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all mt-4 flex items-center justify-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    <span>Send Reset Link</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-stone-100 text-center text-xs text-stone-600 flex items-center justify-between">
                <a href="{{ route('login') }}" class="font-semibold text-matcha-800 hover:underline flex items-center gap-1">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Back to Sign In</span>
                </a>
                <a href="{{ route('register') }}" class="font-semibold text-stone-600 hover:underline">
                    Create Account
                </a>
            </div>

        </div>
    </div>

@endsection
