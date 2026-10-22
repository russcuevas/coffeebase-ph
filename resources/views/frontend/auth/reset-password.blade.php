@extends('layouts.app')

@section('title', 'Set New Password | Coffee Base Philippines')

@section('content')

    <div class="max-w-md mx-auto px-4 sm:px-6 py-16">
        <div class="bg-white rounded-2xl border border-stone-200 p-8 sm:p-10 shadow-lg">
            
            <div class="text-center mb-8">
                <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">珈琲・抹茶基地</span>
                <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950 mt-1">Set New Password</h1>
                <p class="text-xs text-stone-500 mt-1">Create a new, strong password for your Coffee Base account.</p>
            </div>

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

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="reset_email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email Address</label>
                    <input type="email" id="reset_email" name="email" required readonly value="{{ old('email', $email ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-stone-200 bg-stone-50 text-sm text-stone-600 outline-none">
                </div>

                <div>
                    <label for="reset_password" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">New Password</label>
                    <input type="password" id="reset_password" name="password" required placeholder="At least 6 characters" class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <div>
                    <label for="reset_password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Confirm New Password</label>
                    <input type="password" id="reset_password_confirmation" name="password_confirmation" required placeholder="Repeat your new password" class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all mt-4 flex items-center justify-center gap-2">
                    <i data-lucide="key" class="w-4 h-4"></i>
                    <span>Update Password</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-stone-100 text-center text-xs text-stone-600">
                <a href="{{ route('login') }}" class="font-semibold text-matcha-800 hover:underline flex items-center justify-center gap-1">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Back to Sign In</span>
                </a>
            </div>

        </div>
    </div>

@endsection
