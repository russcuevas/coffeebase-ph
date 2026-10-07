@extends('layouts.app')

@section('title', 'Contact Us | Coffee Base Philippines')
@section('meta_description', 'Have a question about our products, your order or wholesale purchases? Connect with Coffee
    Base Philippines on Facebook, Instagram, or through our contact form.')

@section('content')

    <!-- ==========================================
             CONTACT HERO VIDEO BANNER (SABO STYLE)
             ========================================== -->
    <section
        class="relative w-full min-h-[50svh] sm:min-h-[60svh] lg:min-h-[68svh] flex flex-col justify-end overflow-hidden bg-stone-950 text-white border-b border-stone-800">

        <!-- Video Background with Poster Fallback -->
        <div class="absolute inset-0 z-0">
            <video class="w-full h-full object-cover opacity-85 scale-100" autoplay muted loop playsinline preload="auto"
                poster="/uploads/260417_KOKAEN_133240.jpg">
                <source src="/uploads/video3.mp4" type="video/mp4">
            </video>
            <!-- Gradient Overlay Layers -->
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/45 to-stone-900/30"></div>
            <div class="absolute inset-0 bg-black/25"></div>
        </div>

        <!-- Banner Content Container -->
        <div class="relative z-10 max-w-7xl w-full mx-auto px-5 sm:px-8 lg:px-12 py-10 sm:py-14 lg:py-16">

            <!-- Top Band Metadata -->
            <div
                class="border-b border-white/20 pb-3 mb-6 flex flex-wrap items-center justify-between gap-4 font-mono text-[10px] sm:text-xs uppercase tracking-[0.25em] text-cream-200/90">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>COFFEE BASE PHILIPPINES — INQUIRIES &amp; WHOLESALE</span>
                </div>
                <div class="text-right text-stone-300/80">
                    <span>№ 01 / GET IN TOUCH</span>
                </div>
            </div>

            <!-- Title & Subtitle -->
            <div class="max-w-3xl space-y-3 sm:space-y-4">
                <h1
                    class="text-3xl sm:text-5xl md:text-6xl font-serif font-bold tracking-[-0.03em] leading-tight text-white">
                    Contact Us
                </h1>
                <p class="max-w-2xl text-xs sm:text-sm font-light text-cream-100/90 leading-relaxed">
                    Questions about our single-origin matcha reserves, order tracking, or café wholesale partnerships? Our
                    tea team is here to assist you.
                </p>
            </div>

        </div>
    </section>

    <!-- Contact Content & Form Area -->
    <div class="bg-[#fbfaf6] min-h-screen py-16 sm:py-24 border-b border-stone-200">
        <div class="max-w-4xl mx-auto px-6 sm:px-8">

            <!-- Contact Info & Social Media Links (Facebook & Instagram Themed) -->
            <div class="bg-white rounded-3xl border border-stone-200/90 shadow-sm p-8 sm:p-12 mb-10 space-y-8">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-stone-200">
                    <div class="space-y-2">
                        <span class="text-xs font-mono uppercase tracking-[0.25em] text-matcha-800 font-bold">Connect
                            Directly</span>
                        <h2 class="text-2xl font-serif font-bold text-stone-950">COFFEE BASE Philippines</h2>
                        <p class="text-xs sm:text-sm text-stone-600 font-light max-w-md">
                            Follow our social channels for latest harvest updates, brewing guides, and wholesale events.
                        </p>
                    </div>

                    <!-- Social Media Themed Buttons (Facebook & Instagram) -->
                    <div class="flex flex-wrap items-center gap-3">

                        <!-- Facebook Button (Theme Matched) -->
                        <a href="https://www.facebook.com/coffeebasephilippines" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 px-5 py-3 rounded-2xl bg-matcha-900 text-cream-50 hover:bg-matcha-800 hover:scale-105 active:scale-95 transition-all duration-300 shadow-sm group"
                            title="Visit Facebook Page">
                            <svg class="w-4 h-4 text-[#dcb35c] group-hover:text-white transition-colors" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="text-xs font-mono font-semibold uppercase tracking-wider">Facebook</span>
                        </a>

                        <!-- Instagram Button (Theme Matched) -->
                        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 px-5 py-3 rounded-2xl bg-matcha-900 text-cream-50 hover:bg-matcha-800 hover:scale-105 active:scale-95 transition-all duration-300 shadow-sm group"
                            title="Visit Instagram Profile">
                            <svg class="w-4 h-4 text-[#dcb35c] group-hover:text-white transition-colors" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                            <span class="text-xs font-mono font-semibold uppercase tracking-wider">Instagram</span>
                        </a>

                    </div>
                </div>

                <!-- Contact Message Form -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs font-mono uppercase tracking-[0.25em] text-matcha-800 font-bold">Send an
                            Inquiry</span>
                        <h3 class="text-xl sm:text-2xl font-serif font-bold text-stone-950">Send Us a Message</h3>
                        <p class="text-xs sm:text-sm text-stone-600 font-light">
                            Please fill out the details below. For order-specific inquiries, kindly provide your order
                            number.
                        </p>
                    </div>

                    @if (session('success'))
                        <div
                            class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5 pt-2">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact_name"
                                    class="block text-xs font-mono uppercase tracking-wider text-stone-700 mb-2">Your Name
                                    *</label>
                                <input type="text" id="contact_name" name="name" required
                                    value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="e.g. Maria Santos"
                                    class="w-full px-4 py-3 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-700 outline-none bg-[#fbfaf6] focus:bg-white transition-all">
                            </div>

                            <div>
                                <label for="contact_email"
                                    class="block text-xs font-mono uppercase tracking-wider text-stone-700 mb-2">Email
                                    Address *</label>
                                <input type="email" id="contact_email" name="email" required
                                    value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="maria@example.com"
                                    class="w-full px-4 py-3 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-700 outline-none bg-[#fbfaf6] focus:bg-white transition-all">
                            </div>
                        </div>

                        <div>
                            <label for="contact_phone"
                                class="block text-xs font-mono uppercase tracking-wider text-stone-700 mb-2">Phone Number
                                (Optional)</label>
                            <input type="tel" id="contact_phone" name="phone"
                                value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="e.g. 0917 123 4567"
                                class="w-full px-4 py-3 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-700 outline-none bg-[#fbfaf6] focus:bg-white transition-all">
                        </div>

                        <div>
                            <label for="contact_comment"
                                class="block text-xs font-mono uppercase tracking-wider text-stone-700 mb-2">Your Message /
                                Inquiry *</label>
                            <textarea id="contact_comment" name="comment" rows="5" required
                                placeholder="Write your message, order number, or wholesale requirements here..."
                                class="w-full px-4 py-3 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-700 outline-none bg-[#fbfaf6] focus:bg-white transition-all">{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-stone-950 hover:bg-matcha-900 text-cream-50 text-xs font-mono font-semibold uppercase tracking-[0.2em] rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                            Send Message
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
