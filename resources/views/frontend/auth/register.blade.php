@extends('layouts.app')

@section('title', 'Create an Account | Coffee Base Philippines')

@section('content')

    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-12">
        <div class="bg-white rounded-2xl border border-stone-200 p-8 sm:p-10 shadow-lg">
            
            <div class="text-center mb-8">
                <span class="text-xs uppercase tracking-[0.3em] text-matcha-700 font-bold font-sans">Join the Base Community</span>
                <h1 class="text-3xl font-sans font-bold tracking-tight text-matcha-950 mt-1">Create Customer Account</h1>
                <p class="text-xs text-stone-500 mt-1">Save your shipping address for fast 1-click checkout & live order tracking</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="reg_first_name" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">First Name *</label>
                        <input type="text" id="reg_first_name" name="first_name" required value="{{ old('first_name') }}" placeholder="Juan" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>

                    <div>
                        <label for="reg_last_name" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Last Name *</label>
                        <input type="text" id="reg_last_name" name="last_name" required value="{{ old('last_name') }}" placeholder="Dela Cruz" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="reg_email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Email Address *</label>
                        <input type="email" id="reg_email" name="email" required value="{{ old('email') }}" placeholder="juan@example.com" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>

                    <div>
                        <label for="reg_phone" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Phone Number (For Delivery Updates)</label>
                        <input type="tel" id="reg_phone" name="phone" value="{{ old('phone') }}" placeholder="0917 123 4567" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="reg_password" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Password *</label>
                        <input type="password" id="reg_password" name="password" required placeholder="Minimum 6 characters" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>

                    <div>
                        <label for="reg_password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Confirm Password *</label>
                        <input type="password" id="reg_password_confirmation" name="password_confirmation" required placeholder="Re-type password" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="pt-4 border-t border-stone-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-stone-800 mb-3">Saved Shipping Address (Philippines)</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <label for="reg_address" class="block text-xs font-medium text-stone-600 mb-1">Street Address / Building</label>
                            <input type="text" id="reg_address" name="address" value="{{ old('address') }}" placeholder="House #, Street, Subdivision" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label for="reg_barangay" class="block text-xs font-medium text-stone-600 mb-1">Barangay</label>
                                <input type="text" id="reg_barangay" name="barangay" value="{{ old('barangay') }}" placeholder="e.g. San Antonio" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                            <div>
                                <label for="reg_city" class="block text-xs font-medium text-stone-600 mb-1">City / Municipality</label>
                                <input type="text" id="reg_city" name="city" value="{{ old('city') }}" placeholder="e.g. Makati" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                            <div>
                                <label for="reg_postal_code" class="block text-xs font-medium text-stone-600 mb-1">Postal Code</label>
                                <input type="text" id="reg_postal_code" name="postal_code" value="{{ old('postal_code') }}" placeholder="e.g. 1200" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all mt-6">
                    Create Account
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-stone-100 text-center text-xs text-stone-600">
                <span>Already registered?</span>
                <a href="{{ route('login') }}" class="font-bold text-matcha-800 hover:underline ml-1">Log In</a>
            </div>

        </div>
    </div>

@endsection
