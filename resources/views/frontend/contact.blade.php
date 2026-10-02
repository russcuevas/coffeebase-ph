@extends('layouts.app')

@section('title', 'Contact | Coffee Base Philippines')
@section('meta_description', 'Have a question about our products, your order or wholesale purchases? Please send us a message.')

@section('content')

    <!-- Contact Header -->
    <div class="bg-cream-100/70 border-b border-cream-300/80 py-16 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-5xl font-sans font-bold tracking-tight text-matcha-950">
                Contact
            </h1>
        </div>
    </div>

    <!-- Contact Content & Form Area -->
    <div class="max-w-3xl mx-auto px-6 sm:px-8 py-16 sm:py-20">
        
        <!-- Introductory Message -->
        <div class="space-y-4 text-stone-800 mb-10">
            <p class="text-base sm:text-lg font-normal text-stone-900 leading-relaxed">
                Have a question about our products, your order or wholesale purchases?
            </p>
            <p class="text-sm sm:text-base text-stone-700 leading-relaxed font-light">
                Please send us a message using the form below. Our team will get back to you as soon as possible.
            </p>
            <p class="text-xs sm:text-sm text-stone-500 font-medium">
                For order-related inquiries, please include your order number.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-stone-200/80 p-8 sm:p-12">

            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="contact_name"
                            class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-2">Your Name
                            *</label>
                        <input type="text" id="contact_name" name="name" required
                            value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="e.g. Maria Santos"
                            class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 focus:border-matcha-600 outline-none bg-stone-50">
                    </div>

                    <div>
                        <label for="contact_email"
                            class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-2">Email
                            Address *</label>
                        <input type="email" id="contact_email" name="email" required
                            value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="maria@example.com"
                            class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 focus:border-matcha-600 outline-none bg-stone-50">
                    </div>
                </div>

                <div>
                    <label for="contact_phone"
                        class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-2">Phone Number
                        (Optional)</label>
                    <input type="tel" id="contact_phone" name="phone"
                        value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="e.g. 0917 123 4567"
                        class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 focus:border-matcha-600 outline-none bg-stone-50">
                </div>

                <div>
                    <label for="contact_comment"
                        class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-2">Your Message /
                        Comment *</label>
                    <textarea id="contact_comment" name="comment" rows="5" required
                        placeholder="Write your inquiry or feedback here (include order number if applicable)..."
                        class="w-full px-4 py-3 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 focus:border-matcha-600 outline-none bg-stone-50">{{ old('comment') }}</textarea>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-semibold uppercase tracking-[0.2em] rounded-lg shadow-md hover:shadow-lg transition-all">
                    Send Message
                </button>
            </form>

        </div>
    </div>

@endsection
