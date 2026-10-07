<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Coffee Base Philippines | Artisanal Japanese Matcha & Specialty Blends')</title>
    <meta name="description" content="@yield('meta_description', 'Directly sourced ceremonial and barista grade Japanese matcha from Uji, Kyoto and Yame, Fukuoka. Explore single cultivar reserves, whisk tools, and wholesale matcha in the Philippines.')">

    <!-- Google Fonts (Japanese & Luxury Editorial Typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Zen+Old+Mincho:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        matcha: {
                            50: '#f4f7f4',
                            100: '#e5ece5',
                            200: '#cad9cb',
                            300: '#a3beaa',
                            400: '#759d80',
                            500: '#52805f',
                            600: '#3d664a',
                            700: '#32523c',
                            800: '#284131',
                            900: '#1b2c21',
                            950: '#0f1a13',
                        },
                        cream: {
                            50: '#fdfcf7',
                            100: '#fbfaf2',
                            200: '#f6f3e3',
                            300: '#eee8cb',
                            400: '#e2d7ad',
                            500: '#d4c38d',
                            800: '#463e26',
                            900: '#2b2617',
                        },
                        gold: {
                            400: '#dcb35c',
                            500: '#c59b3f',
                            600: '#aa7e2a',
                        }
                    },
                    fontFamily: {
                        serif: ['"Zen Old Mincho"', '"Cormorant Garamond"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', '"Inter"', 'sans-serif'],
                        mono: ['"SF Mono"', 'ui-monospace', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #fbfaf6;
            color: #243026;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        .font-serif-luxury {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        .japanese-subtext {
            font-size: 0.72rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .glass-header {
            background: rgba(251, 250, 246, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Matcha Theme SweetAlert2 Toast */
        .coffeebase-toast-popup {
            background: #1b2c21 !important; /* matcha-900 */
            color: #fbfaf2 !important; /* cream-100 */
            border: 1px solid rgba(212, 195, 141, 0.35) !important;
            border-radius: 1rem !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4), 0 8px 10px -6px rgba(0, 0, 0, 0.3) !important;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
            padding: 0.85rem 1.25rem !important;
        }
        .coffeebase-toast-popup .swal2-title {
            color: #fbfaf2 !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            line-height: 1.35 !important;
        }
        .coffeebase-toast-popup .swal2-html-container {
            color: #cad9cb !important;
            font-size: 0.75rem !important;
        }
        .coffeebase-toast-popup .swal2-timer-progress-bar {
            background: #dcb35c !important; /* gold-400 */
            height: 3px !important;
        }
        .coffeebase-toast-popup .swal2-icon.swal2-success {
            border-color: #52805f !important;
            color: #759d80 !important;
        }
        .coffeebase-toast-popup .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: #759d80 !important;
        }
        .coffeebase-toast-popup .swal2-icon.swal2-success .swal2-success-ring {
            border: .25em solid rgba(117, 157, 128, 0.4) !important;
        }
        .coffeebase-toast-popup .swal2-icon.swal2-error {
            border-color: #f43f5e !important;
            color: #f43f5e !important;
        }
        .coffeebase-toast-popup .swal2-icon.swal2-info {
            border-color: #dcb35c !important;
            color: #dcb35c !important;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col antialiased selection:bg-matcha-600 selection:text-white">

    <!-- Top Announcement Bar -->
    <div
        class="bg-matcha-950 text-cream-100 text-xs sm:text-sm py-2.5 px-4 text-center font-sans font-medium tracking-normal flex justify-center items-center gap-1">
        <span>Japanese</span>
        <span class="text-[10px] font-bold tracking-tight uppercase opacity-90">JP</span>
        <span>Matcha 🍵, Now Available in the Philippines</span>
        <span class="text-[10px] font-bold tracking-tight uppercase opacity-90">PH</span>.
    </div>

    <!-- Navigation Header -->
    <header class="glass-header sticky top-0 z-40 border-b border-cream-300/60 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Desktop & Mobile Header Layout -->
            <div class="flex items-center justify-between h-20 sm:h-24">

                <!-- Left: Navigation (Desktop) / Menu Button (Mobile) -->
                <div class="flex items-center">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden text-stone-900 p-2 hover:text-matcha-700 transition-colors" aria-label="Open Menu">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    <!-- Desktop Navigation Links (Left side or Full) -->
                    <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8 text-xs font-mono uppercase tracking-[0.18em]">
                        <a href="{{ route('home') }}"
                            class="transition-colors pb-0.5 {{ request()->routeIs('home') && !request()->has('category') ? 'text-stone-950 font-bold border-b border-stone-950' : 'text-stone-700 hover:text-stone-950' }}">
                            Home
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'single-origin-matcha']) }}"
                            class="transition-colors pb-0.5 {{ request('category') === 'single-origin-matcha' || request('category') === 'singles-origin' || request('category') === 'single-origin' ? 'text-stone-950 font-bold border-b border-stone-950' : 'text-stone-700 hover:text-stone-950' }}">
                            Singles Origin
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'matcha-blends']) }}"
                            class="transition-colors pb-0.5 {{ request('category') === 'matcha-blends' || request('category') === 'blends' ? 'text-stone-950 font-bold border-b border-stone-950' : 'text-stone-700 hover:text-stone-950' }}">
                            Matcha Blends
                        </a>
                    </nav>
                </div>

                <!-- Center: Brand Logo (Centered like Sabo Matcha) -->
                <div class="absolute left-1/2 -translate-x-1/2 text-center pointer-events-auto">
                    <a href="{{ route('home') }}" class="inline-flex flex-col items-center group">
                        <span class="text-lg sm:text-2xl font-serif font-bold tracking-[-0.03em] text-stone-950 uppercase group-hover:text-matcha-800 transition-colors">
                            COFFEE BASE
                        </span>
                        <span class="text-[9px] sm:text-[10px] font-mono tracking-[0.35em] text-stone-500 uppercase -mt-0.5 group-hover:text-stone-800 transition-colors">
                            Philippines
                        </span>
                    </a>
                </div>

                <!-- Right: Navigation Links (About & Contact) + Utilities (Account, Cart) -->
                <div class="flex items-center space-x-4 sm:space-x-6">
                    
                    <!-- Desktop Right Nav Links -->
                    <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8 text-xs font-mono uppercase tracking-[0.18em]">
                        <a href="{{ route('about') }}"
                            class="transition-colors pb-0.5 {{ request()->routeIs('about') ? 'text-stone-950 font-bold border-b border-stone-950' : 'text-stone-700 hover:text-stone-950' }}">
                            About Us
                        </a>
                        <a href="{{ route('contact') }}"
                            class="transition-colors pb-0.5 {{ request()->routeIs('contact') ? 'text-stone-950 font-bold border-b border-stone-950' : 'text-stone-700 hover:text-stone-950' }}">
                            Contact
                        </a>
                    </nav>

                    <div class="h-4 w-px bg-stone-300 hidden lg:block"></div>

                    <!-- Account / Auth -->
                    @auth
                        <div class="relative" id="user-dropdown-wrapper">
                            <button id="user-dropdown-btn" type="button" class="flex items-center space-x-1.5 text-stone-900 hover:text-matcha-700 py-2 focus:outline-none transition-colors">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                                <span
                                    class="text-[11px] font-mono uppercase tracking-wider hidden xl:inline">{{ auth()->user()->first_name ?? 'Account' }}</span>
                                <i data-lucide="chevron-down" id="user-dropdown-chevron" class="w-3.5 h-3.5 transition-transform duration-200"></i>
                            </button>
                            <div id="user-dropdown-menu"
                                class="absolute right-0 w-52 mt-2 py-2 bg-white rounded-xl shadow-xl border border-stone-200 hidden transition-all z-50">
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center px-4 py-2 text-xs font-mono uppercase tracking-wider text-amber-800 bg-amber-50 hover:bg-amber-100">
                                        <i data-lucide="shield-alert" class="w-4 h-4 mr-2"></i> Admin Panel
                                    </a>
                                    <hr class="my-1 border-stone-100">
                                @endif
                                <button type="button" onclick="openCustomerProfileModal()"
                                    class="w-full text-left flex items-center px-4 py-2 text-xs font-mono uppercase tracking-wider text-stone-700 hover:bg-stone-50 transition-colors">
                                    <i data-lucide="user-pen" class="w-4 h-4 mr-2 text-matcha-700"></i> Account Details
                                </button>
                                <a href="{{ route('orders.my_orders') }}"
                                    class="flex items-center px-4 py-2 text-xs font-mono uppercase tracking-wider text-stone-700 hover:bg-stone-50 transition-colors">
                                    <i data-lucide="package" class="w-4 h-4 mr-2 text-stone-500"></i> My Orders
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left flex items-center px-4 py-2 text-xs font-mono uppercase tracking-wider text-rose-700 hover:bg-rose-50 transition-colors">
                                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="flex items-center space-x-1 text-stone-900 hover:text-matcha-700 transition-colors py-2"
                            title="Login / Register">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span class="text-[11px] font-mono uppercase tracking-wider hidden xl:inline">Sign In</span>
                        </a>
                    @endauth

                    <!-- Cart Drawer / Link -->
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = count($cartItems);
                    @endphp
                    <button type="button" onclick="openCartDrawer()"
                        class="relative text-stone-900 hover:text-matcha-700 transition-colors p-2 flex items-center"
                        title="Shopping Cart" aria-label="Open Shopping Bag">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        <span id="global-cart-badge"
                            class="{{ $cartCount > 0 ? '' : 'hidden' }} absolute -top-0.5 -right-0.5 bg-matcha-800 text-cream-50 text-[10px] font-mono font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">
                            {{ $cartCount }}
                        </span>
                    </button>

                </div>

            </div>
        </div>

        <!-- Mobile Nav Menu Drawer/Dropdown -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-stone-200 px-6 py-6 space-y-4">
            <div class="space-y-3 font-mono text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('home') }}"
                    class="block py-2 text-stone-900 hover:text-matcha-700 border-b border-stone-100 {{ request()->routeIs('home') && !request()->has('category') ? 'font-bold text-matcha-800' : '' }}">
                    Home
                </a>
                <a href="{{ route('shop.index', ['category' => 'single-origin-matcha']) }}"
                    class="block py-2 text-stone-900 hover:text-matcha-700 border-b border-stone-100 {{ request('category') === 'single-origin-matcha' ? 'font-bold text-matcha-800' : '' }}">
                    Singles Origin
                </a>
                <a href="{{ route('shop.index', ['category' => 'matcha-blends']) }}"
                    class="block py-2 text-stone-900 hover:text-matcha-700 border-b border-stone-100 {{ request('category') === 'matcha-blends' ? 'font-bold text-matcha-800' : '' }}">
                    Matcha Blends
                </a>
                <a href="{{ route('about') }}"
                    class="block py-2 text-stone-900 hover:text-matcha-700 border-b border-stone-100 {{ request()->routeIs('about') ? 'font-bold text-matcha-800' : '' }}">
                    About Us
                </a>
                <a href="{{ route('contact') }}"
                    class="block py-2 text-stone-900 hover:text-matcha-700 border-b border-stone-100 {{ request()->routeIs('contact') ? 'font-bold text-matcha-800' : '' }}">
                    Contact
                </a>
            </div>

            @auth
                <div class="pt-4 border-t border-stone-200 space-y-2 font-mono text-xs uppercase tracking-wider">
                    <button type="button" onclick="openCustomerProfileModal()"
                        class="w-full text-left flex items-center py-2 text-stone-800 hover:text-matcha-700">
                        <i data-lucide="user-pen" class="w-4 h-4 mr-2 text-matcha-700"></i> Account Details
                    </button>
                    <a href="{{ route('orders.my_orders') }}"
                        class="flex items-center py-2 text-stone-800 hover:text-matcha-700">
                        <i data-lucide="package" class="w-4 h-4 mr-2 text-stone-500"></i> My Orders
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="block py-2 font-bold text-amber-800">Admin Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="pt-2">
                        @csrf
                        <button type="submit" class="text-rose-700 font-semibold py-1">Sign Out</button>
                    </form>
                </div>
            @else
                <div class="pt-4 border-t border-stone-200">
                    <a href="{{ route('login') }}"
                        class="block py-2 text-xs font-mono uppercase tracking-wider text-matcha-800 font-bold">
                        Sign In / Register
                    </a>
                </div>
            @endauth
        </div>
    </header>

    <!-- Global Flash Notifications via SweetAlert2 Toast -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('success', @json(session('success')));
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('error', @json(session('error')));
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('error', @json($errors->first()));
            });
        </script>
    @endif

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-stone-200 text-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                <!-- Stay Connected Text -->
                <div class="space-y-1 max-w-md">
                    <h3 class="text-xl font-sans font-bold tracking-tight text-stone-950">Stay Connected</h3>
                    <p class="text-xs text-stone-600 font-light">
                        Get product updates, new arrivals and news from COFFEE BASE Philippines.
                    </p>
                </div>

                <!-- Email Subscribe Input Pill -->
                <div class="w-full md:w-auto md:min-w-[420px]">
                    <form action="#" method="POST" onsubmit="event.preventDefault(); showToast('success', 'Thank you for subscribing to COFFEE BASE Philippines!'); this.reset();" class="relative flex items-center">
                        <input type="email" required placeholder="Email address" 
                            class="w-full pl-6 pr-14 py-3.5 text-xs rounded-full border border-stone-300 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 outline-none transition-all placeholder:text-stone-400 bg-white">
                        <button type="submit" aria-label="Subscribe" class="absolute right-2.5 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center text-stone-700 hover:text-stone-950 hover:bg-stone-100 transition-colors">
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Copyright & Policy Links -->
            <div class="mt-16 pt-8 border-t border-stone-200/80 flex flex-col sm:flex-row items-center justify-between text-[11px] text-stone-500 gap-4">
                <p>© {{ date('Y') }} COFFEE BASE Philippines</p>
                <div>
                    <a href="{{ route('shop.index') }}" class="hover:text-stone-900 transition-colors">Terms and Policies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Slide-Out Cart Drawer -->
    <div id="cart-drawer-container" class="relative z-50 pointer-events-none transition-opacity duration-300 opacity-0" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <!-- Backdrop Overlay -->
        <div id="cart-drawer-backdrop" onclick="closeCartDrawer()" class="fixed inset-0 bg-stone-950/40 backdrop-blur-xs transition-opacity opacity-0 cursor-pointer"></div>

        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-6 sm:pl-10">
                    <!-- Drawer Slide-in Panel -->
                    <div id="cart-drawer-panel" class="pointer-events-auto w-screen max-w-md transform transition ease-in-out duration-300 translate-x-full bg-white shadow-2xl flex flex-col">
                        
                        <!-- Header -->
                        <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <h2 class="text-base font-sans font-bold text-stone-950 tracking-tight" id="slide-over-title">Shopping Cart</h2>
                                <span id="cart-drawer-count-badge" class="px-2 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">0 items</span>
                            </div>
                            <button type="button" onclick="closeCartDrawer()" class="p-2 text-stone-400 hover:text-stone-700 hover:bg-stone-50 rounded-full transition-colors">
                                <span class="sr-only">Close panel</span>
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <!-- Scrollable Items Area -->
                        <div id="cart-drawer-body" class="flex-1 overflow-y-auto px-6 py-4 divide-y divide-stone-100">
                            <!-- Items dynamically rendered here -->
                        </div>

                        <!-- Empty State Notice (hidden by default) -->
                        <div id="cart-drawer-empty" class="hidden flex-1 flex-col items-center justify-center p-8 text-center space-y-4">
                            <div class="w-16 h-16 rounded-full bg-stone-50 flex items-center justify-center text-stone-400">
                                <i data-lucide="shopping-bag" class="w-8 h-8"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-stone-900 font-sans">Your cart is empty</h3>
                                <p class="text-xs text-stone-500 mt-1 max-w-xs font-light">Explore our authentic single origin Kyoto matcha and specialty blends.</p>
                            </div>
                            <a href="{{ route('shop.index') }}" onclick="closeCartDrawer()" class="inline-block px-6 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-wider rounded-lg transition-colors">
                                Explore Matcha
                            </a>
                        </div>

                        <!-- Footer / Checkout Area -->
                        <div id="cart-drawer-footer" class="border-t border-stone-200 bg-stone-50/70 px-6 py-5 space-y-4">
                            <!-- Subtotal -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-stone-500">Estimated Total</span>
                                <span id="cart-drawer-subtotal" class="text-lg font-sans font-bold text-stone-950">₱0.00</span>
                            </div>

                            <p class="text-[11px] text-stone-500 leading-tight">
                                Taxes and shipping calculated at checkout. Delivery arrangement via Grab / Lalamove / LBC.
                            </p>

                            <!-- Actions -->
                            <div class="space-y-2 pt-1">
                                <a href="{{ route('checkout.index') }}" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-lg shadow transition-all flex items-center justify-center gap-2 group">
                                    <span>Proceed to Checkout</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                                </a>
                                <a href="{{ route('cart.index') }}" class="block text-center py-2 text-xs font-semibold text-stone-600 hover:text-stone-950 transition-colors">
                                    View Full Cart
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Add / Quick View Modal -->
    <div id="quick-add-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 opacity-0 pointer-events-none transition-opacity duration-300" aria-modal="true" role="dialog">
        <!-- Backdrop -->
        <div id="quick-add-backdrop" onclick="closeQuickAddModal()" class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity opacity-0 cursor-pointer"></div>

        <!-- Modal Box -->
        <div id="quick-add-card" class="relative bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 overflow-hidden">
            <!-- Close Button -->
            <button type="button" onclick="closeQuickAddModal()" class="absolute top-5 right-5 text-stone-400 hover:text-stone-800 p-1.5 rounded-full hover:bg-stone-100 transition-colors z-20">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 items-center">
                <!-- Left: Product Image -->
                <div class="aspect-square bg-stone-50 rounded-2xl flex items-center justify-center p-4 overflow-hidden border border-stone-100">
                    <img id="quick-modal-image" src="" alt="" class="w-full h-full object-contain">
                </div>

                <!-- Right: Product Details & Controls -->
                <div class="flex flex-col justify-between space-y-5">
                    <div>
                        <h3 id="quick-modal-title" class="text-xl sm:text-2xl font-sans font-bold text-stone-950 tracking-tight leading-snug"></h3>
                        <p id="quick-modal-price" class="text-base sm:text-lg font-sans font-bold text-stone-900 mt-1.5"></p>
                    </div>

                    <!-- Weight / Variants -->
                    <div>
                        <label class="block text-xs font-semibold text-stone-800 mb-2">Weight</label>
                        <div id="quick-modal-variants" class="flex flex-wrap gap-2.5">
                            <!-- Injected dynamically -->
                        </div>
                    </div>

                    <!-- Actions & Stepper -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center gap-3">
                            <!-- Stepper -->
                            <div class="flex items-center border border-stone-300 rounded-xl bg-white overflow-hidden">
                                <button type="button" onclick="changeQuickModalQty(-1)" class="px-3.5 py-3 text-stone-500 hover:bg-stone-100 transition-colors">
                                    <i data-lucide="minus" class="w-4 h-4"></i>
                                </button>
                                <input type="number" id="quick-modal-qty" value="1" min="1" max="99" class="w-12 text-center text-sm font-semibold text-stone-900 focus:outline-none py-2.5">
                                <button type="button" onclick="changeQuickModalQty(1)" class="px-3.5 py-3 text-stone-500 hover:bg-stone-100 transition-colors">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                </button>
                            </div>

                            <!-- Add to cart button -->
                            <button type="button" id="quick-modal-add-btn" onclick="submitQuickAddToCart(false)" class="flex-1 py-3 px-4 bg-black hover:bg-stone-800 text-white text-xs sm:text-sm font-semibold rounded-xl transition-colors flex items-center justify-center gap-2 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/><line x1="12" y1="13" x2="12" y2="19"/><line x1="9" y1="16" x2="15" y2="16"/>
                                </svg>
                                <span>Add to cart</span>
                            </button>
                        </div>

                        <!-- Buy it now button -->
                        <button type="button" id="quick-modal-buy-btn" onclick="submitQuickAddToCart(true)" class="w-full py-3.5 bg-black hover:bg-stone-800 text-white text-xs sm:text-sm font-semibold rounded-xl transition-colors text-center shadow">
                            Buy it now
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @auth
    <!-- CUSTOMER PROFILE & DETAILS MODAL -->
    <div id="customer-profile-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity cursor-pointer" onclick="closeCustomerProfileModal()"></div>
        <div class="relative bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 max-h-[90vh] overflow-y-auto" id="customer-profile-card">
            
            <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-matcha-700 text-cream-50 flex items-center justify-center font-bold text-sm shadow-xs">
                        {{ strtoupper(substr(auth()->user()->first_name ?: auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?: (explode(' ', auth()->user()->name)[1] ?? ''), 0, 1)) ?: 'C' }}
                    </div>
                    <div>
                        <h3 class="text-base font-sans font-bold text-stone-950">Account & Delivery Details</h3>
                        <p class="text-xs text-stone-500">Update your customer profile and shipping address</p>
                    </div>
                </div>
                <button type="button" onclick="closeCustomerProfileModal()" class="text-stone-400 hover:text-stone-700 p-1.5 rounded-full hover:bg-stone-100 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-4 pt-4">
                @csrf
                @method('PUT')

                <!-- Personal Info -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-matcha-900 flex items-center gap-1.5">
                        <i data-lucide="user" class="w-3.5 h-3.5"></i>
                        <span>Personal Information</span>
                    </h4>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name ?: explode(' ', auth()->user()->name)[0]) }}" required class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name ?: (explode(' ', auth()->user()->name)[1] ?? '')) }}" required class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Mobile Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="0917 123 4567" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Company / Cafe Name (Optional)</label>
                        <input type="text" name="company" value="{{ old('company', auth()->user()->company) }}" placeholder="e.g. Kyoto Cafe" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="pt-3 border-t border-stone-100 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-matcha-900 flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                        <span>Default Shipping & Delivery Address</span>
                    </h4>

                    <div>
                        <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Street Address / House No. / Building</label>
                        <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}" placeholder="123 Matcha Ave, Unit 4B" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Apartment / Suite / Unit</label>
                            <input type="text" name="apartment" value="{{ old('apartment', auth()->user()->apartment) }}" placeholder="Tower 1, 12th Floor" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Barangay</label>
                            <input type="text" name="barangay" value="{{ old('barangay', auth()->user()->barangay) }}" placeholder="Brgy. San Antonio" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">City / Municipality</label>
                            <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" placeholder="Makati City" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Region / Province</label>
                            <input type="text" name="region" value="{{ old('region', auth()->user()->region) }}" placeholder="Metro Manila" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-stone-700 mb-1">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}" placeholder="1203" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs sm:text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Password Change (Optional) -->
                <div class="pt-3 border-t border-stone-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-stone-800 flex items-center gap-1.5">
                            <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                            <span>Security & Password</span>
                        </span>
                        <span class="text-[10px] text-stone-400">Leave blank if no changes</span>
                    </div>

                    <div class="space-y-2.5">
                        <div>
                            <label class="block text-[11px] font-semibold text-stone-600 mb-1">Current Password (Required only to change password)</label>
                            <input type="password" name="current_password" placeholder="••••••••" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-semibold text-stone-600 mb-1">New Password</label>
                                <input type="password" name="password" placeholder="Min 6 characters" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-stone-600 mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" placeholder="Repeat new password" class="w-full px-3.5 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-stone-100 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeCustomerProfileModal()" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-600 hover:bg-stone-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endauth

    <script>
        lucide.createIcons();

        // Customer Profile Modal Toggle
        function openCustomerProfileModal() {
            const userDropdownMenu = document.getElementById('user-dropdown-menu');
            if (userDropdownMenu) userDropdownMenu.classList.add('hidden');
            const userDropdownChevron = document.getElementById('user-dropdown-chevron');
            if (userDropdownChevron) userDropdownChevron.classList.remove('rotate-180');

            const modal = document.getElementById('customer-profile-modal');
            const card = document.getElementById('customer-profile-card');
            if (modal && card) {
                modal.classList.remove('pointer-events-none', 'opacity-0');
                modal.classList.add('pointer-events-auto', 'opacity-100');
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeCustomerProfileModal() {
            const modal = document.getElementById('customer-profile-modal');
            const card = document.getElementById('customer-profile-card');
            if (modal && card) {
                card.classList.remove('scale-100');
                card.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.remove('pointer-events-auto', 'opacity-100');
                    modal.classList.add('pointer-events-none', 'opacity-0');
                    document.body.style.overflow = '';
                }, 200);
            }
        }
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // User Account Dropdown Click Toggle
        const userDropdownBtn = document.getElementById('user-dropdown-btn');
        const userDropdownMenu = document.getElementById('user-dropdown-menu');
        const userDropdownChevron = document.getElementById('user-dropdown-chevron');

        if (userDropdownBtn && userDropdownMenu) {
            userDropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = userDropdownMenu.classList.contains('hidden');
                if (isHidden) {
                    userDropdownMenu.classList.remove('hidden');
                    if (userDropdownChevron) userDropdownChevron.classList.add('rotate-180');
                } else {
                    userDropdownMenu.classList.add('hidden');
                    if (userDropdownChevron) userDropdownChevron.classList.remove('rotate-180');
                }
            });

            document.addEventListener('click', function(e) {
                if (!userDropdownMenu.contains(e.target) && !userDropdownBtn.contains(e.target)) {
                    userDropdownMenu.classList.add('hidden');
                    if (userDropdownChevron) userDropdownChevron.classList.remove('rotate-180');
                }
            });
        }

        // ================= SWEETALERT2 TOAST PALETTE ================= //
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            customClass: {
                popup: 'coffeebase-toast-popup',
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        function showToast(icon, title, text = '') {
            Toast.fire({
                icon: icon, // 'success', 'error', 'info', 'warning'
                title: title,
                text: text
            });
        }

        // ================= CART DRAWER LOGIC ================= //
        const cartDrawerContainer = document.getElementById('cart-drawer-container');
        const cartDrawerBackdrop = document.getElementById('cart-drawer-backdrop');
        const cartDrawerPanel = document.getElementById('cart-drawer-panel');
        const cartDrawerBody = document.getElementById('cart-drawer-body');
        const cartDrawerEmpty = document.getElementById('cart-drawer-empty');
        const cartDrawerFooter = document.getElementById('cart-drawer-footer');
        const cartDrawerSubtotal = document.getElementById('cart-drawer-subtotal');
        const cartDrawerCountBadge = document.getElementById('cart-drawer-count-badge');
        const globalCartBadge = document.getElementById('global-cart-badge');

        function openCartDrawer() {
            refreshCartDrawer();
            cartDrawerContainer.classList.remove('pointer-events-none', 'opacity-0');
            cartDrawerContainer.classList.add('pointer-events-auto', 'opacity-100');
            
            cartDrawerBackdrop.classList.remove('opacity-0');
            cartDrawerBackdrop.classList.add('opacity-100');
            
            cartDrawerPanel.classList.remove('translate-x-full');
            cartDrawerPanel.classList.add('translate-x-0');

            document.body.style.overflow = 'hidden';
        }

        function closeCartDrawer() {
            cartDrawerPanel.classList.remove('translate-x-0');
            cartDrawerPanel.classList.add('translate-x-full');

            cartDrawerBackdrop.classList.remove('opacity-100');
            cartDrawerBackdrop.classList.add('opacity-0');

            setTimeout(() => {
                cartDrawerContainer.classList.remove('pointer-events-auto', 'opacity-100');
                cartDrawerContainer.classList.add('pointer-events-none', 'opacity-0');
                if (!document.getElementById('quick-add-modal').classList.contains('opacity-100')) {
                    document.body.style.overflow = '';
                }
            }, 300);
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const customerProfileModal = document.getElementById('customer-profile-modal');
                if (customerProfileModal && customerProfileModal.classList.contains('opacity-100')) {
                    closeCustomerProfileModal();
                    return;
                }
                const quickModal = document.getElementById('quick-add-modal');
                if (quickModal && quickModal.classList.contains('opacity-100')) {
                    closeQuickAddModal();
                    return;
                }
                if (!cartDrawerPanel.classList.contains('translate-x-full')) {
                    closeCartDrawer();
                }
            }
        });

        async function refreshCartDrawer() {
            try {
                const res = await fetch('/cart/data', {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();
                renderCartDrawer(data);
            } catch (err) {
                console.error('Failed to load cart data:', err);
            }
        }

        function renderCartDrawer(data) {
            if (!data || !data.cart) return;

            const items = data.cart;
            const count = data.cart_count; // Unique items count
            const subtotalFormatted = data.formatted_subtotal || '₱0.00';

            // Update badge in navigation
            if (globalCartBadge) {
                if (count > 0) {
                    globalCartBadge.textContent = count;
                    globalCartBadge.classList.remove('hidden');
                } else {
                    globalCartBadge.classList.add('hidden');
                }
            }

            // Update drawer title badge
            if (cartDrawerCountBadge) {
                cartDrawerCountBadge.textContent = `${count} ${count === 1 ? 'item' : 'items'}`;
            }

            // Update subtotal
            if (cartDrawerSubtotal) {
                cartDrawerSubtotal.textContent = subtotalFormatted;
            }

            // Render list
            if (items.length === 0) {
                cartDrawerBody.innerHTML = '';
                cartDrawerBody.classList.add('hidden');
                cartDrawerEmpty.classList.remove('hidden');
                cartDrawerEmpty.classList.add('flex');
                cartDrawerFooter.classList.add('hidden');
            } else {
                cartDrawerEmpty.classList.add('hidden');
                cartDrawerEmpty.classList.remove('flex');
                cartDrawerBody.classList.remove('hidden');
                cartDrawerFooter.classList.remove('hidden');

                let html = '';
                items.forEach(item => {
                    const itemTotal = (item.price * item.quantity).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    const unitPrice = item.price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    const productUrl = `/product/${item.slug || ''}`;

                    html += `
                        <div class="py-4 flex gap-4 items-start group">
                            <!-- Image -->
                            <a href="${productUrl}" class="w-18 h-18 sm:w-20 sm:h-20 rounded-xl bg-stone-50 border border-stone-200/80 p-1 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                <img src="${item.image}" alt="${item.name}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </a>

                            <!-- Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start gap-2">
                                    <a href="${productUrl}" class="text-xs sm:text-sm font-sans font-bold text-stone-900 hover:text-matcha-800 transition-colors line-clamp-2 leading-tight">
                                        ${item.name}
                                    </a>
                                    <button type="button" onclick="removeDrawerItem('${item.variant_id}')" class="text-stone-400 hover:text-rose-600 p-1 -mr-1 transition-colors" title="Remove item">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>

                                <div class="text-[11px] text-stone-500 mt-0.5">
                                    <span class="bg-stone-100 px-1.5 py-0.5 rounded font-mono text-[10px] text-stone-700">${item.weight}</span>
                                    <span class="ml-1 font-sans">₱${unitPrice} each</span>
                                </div>

                                <div class="flex items-center justify-between mt-3">
                                    <!-- Stepper -->
                                    <div class="flex items-center border border-stone-200 rounded-lg bg-white overflow-hidden shadow-2xs">
                                        <button type="button" onclick="changeDrawerQty('${item.variant_id}', ${item.quantity - 1})" class="px-2.5 py-1 text-stone-500 hover:bg-stone-100 transition-colors">
                                            <i data-lucide="minus" class="w-3 h-3"></i>
                                        </button>
                                        <span class="px-2 text-xs font-semibold text-stone-900 min-w-[24px] text-center">${item.quantity}</span>
                                        <button type="button" onclick="changeDrawerQty('${item.variant_id}', ${item.quantity + 1})" class="px-2.5 py-1 text-stone-500 hover:bg-stone-100 transition-colors">
                                            <i data-lucide="plus" class="w-3 h-3"></i>
                                        </button>
                                    </div>

                                    <!-- Total for item -->
                                    <span class="text-xs sm:text-sm font-sans font-bold text-stone-950">
                                        ₱${itemTotal}
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                });

                cartDrawerBody.innerHTML = html;
                lucide.createIcons();
            }
        }

        async function changeDrawerQty(variantId, newQty) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                const res = await fetch('{{ route("cart.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ variant_id: variantId, quantity: newQty })
                });
                const data = await res.json();
                if (data.success) {
                    renderCartDrawer(data);
                }
            } catch (err) {
                console.error('Error updating quantity:', err);
            }
        }

        async function removeDrawerItem(variantId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                const res = await fetch('{{ route("cart.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ variant_id: variantId })
                });
                const data = await res.json();
                if (data.success) {
                    renderCartDrawer(data);
                }
            } catch (err) {
                console.error('Error removing item:', err);
            }
        }

        // ================= QUICK ADD MODAL LOGIC ================= //
        let currentQuickProduct = null;
        let currentSelectedVariantId = null;

        function openQuickAddModal(productData) {
            if (!productData) return;
            currentQuickProduct = productData;
            
            document.getElementById('quick-modal-image').src = productData.image;
            document.getElementById('quick-modal-title').textContent = productData.name;
            document.getElementById('quick-modal-qty').value = 1;

            // Render variants
            const variantsContainer = document.getElementById('quick-modal-variants');
            variantsContainer.innerHTML = '';

            if (productData.variants && productData.variants.length > 0) {
                // Select first in-stock variant or first variant
                const firstAvailable = productData.variants.find(v => !v.is_sold_out) || productData.variants[0];
                currentSelectedVariantId = firstAvailable.id;

                productData.variants.forEach(variant => {
                    const isSelected = variant.id === currentSelectedVariantId;
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = `px-5 py-2.5 rounded-xl text-xs transition-all border ${
                        isSelected 
                            ? 'bg-black text-white border-black font-semibold shadow-sm' 
                            : 'bg-white text-stone-900 border-stone-200 hover:border-stone-400 font-normal'
                    } ${variant.is_sold_out ? 'opacity-40 cursor-not-allowed line-through' : ''}`;
                    
                    let weightText = variant.weight;
                    if (weightText.toLowerCase().includes('1kg') && !weightText.toLowerCase().includes('wholesale')) {
                        weightText += ' for Wholesale';
                    }
                    btn.textContent = weightText;
                    
                    btn.onclick = () => {
                        if (variant.is_sold_out) return;
                        selectQuickModalVariant(variant.id);
                    };
                    variantsContainer.appendChild(btn);
                });

                updateQuickModalPrice();
            }

            const modal = document.getElementById('quick-add-modal');
            const backdrop = document.getElementById('quick-add-backdrop');
            const card = document.getElementById('quick-add-card');

            modal.classList.remove('pointer-events-none', 'opacity-0');
            modal.classList.add('pointer-events-auto', 'opacity-100');
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }

        function selectQuickModalVariant(variantId) {
            currentSelectedVariantId = variantId;
            
            // Update active styles
            const buttons = document.querySelectorAll('#quick-modal-variants button');
            currentQuickProduct.variants.forEach((v, idx) => {
                if (buttons[idx]) {
                    if (v.id === variantId) {
                        buttons[idx].className = 'px-5 py-2.5 rounded-xl text-xs transition-all border bg-black text-white border-black font-semibold shadow-sm';
                    } else {
                        buttons[idx].className = 'px-5 py-2.5 rounded-xl text-xs transition-all border bg-white text-stone-900 border-stone-200 hover:border-stone-400 font-normal ' + (v.is_sold_out ? 'opacity-40 cursor-not-allowed line-through' : '');
                    }
                }
            });

            updateQuickModalPrice();
        }

        function updateQuickModalPrice() {
            if (!currentQuickProduct || !currentSelectedVariantId) return;
            const variant = currentQuickProduct.variants.find(v => v.id == currentSelectedVariantId);
            if (!variant) return;

            const priceEl = document.getElementById('quick-modal-price');
            priceEl.textContent = '₱' + Number(variant.price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            const addBtn = document.getElementById('quick-modal-add-btn');
            const buyBtn = document.getElementById('quick-modal-buy-btn');

            if (variant.is_sold_out) {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
                addBtn.innerHTML = '<span>Sold Out</span>';
                buyBtn.disabled = true;
                buyBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                addBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/><line x1="12" y1="13" x2="12" y2="19"/><line x1="9" y1="16" x2="15" y2="16"/>
                    </svg>
                    <span>Add to cart</span>
                `;
                buyBtn.disabled = false;
                buyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function changeQuickModalQty(delta) {
            const input = document.getElementById('quick-modal-qty');
            let val = parseInt(input.value || 1) + delta;
            if (val < 1) val = 1;
            if (val > 99) val = 99;
            input.value = val;
        }

        function closeQuickAddModal() {
            const modal = document.getElementById('quick-add-modal');
            const backdrop = document.getElementById('quick-add-backdrop');
            const card = document.getElementById('quick-add-card');

            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.remove('pointer-events-auto', 'opacity-100');
                modal.classList.add('pointer-events-none', 'opacity-0');
                if (cartDrawerContainer.classList.contains('opacity-0')) {
                    document.body.style.overflow = '';
                }
            }, 200);
        }

        async function submitQuickAddToCart(redirectToCheckout = false) {
            if (!currentSelectedVariantId) return;
            const qty = parseInt(document.getElementById('quick-modal-qty').value || 1);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const addBtn = document.getElementById('quick-modal-add-btn');
            const originalText = addBtn.innerHTML;
            addBtn.disabled = true;
            addBtn.innerHTML = `<span>Adding...</span>`;

            try {
                const res = await fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        variant_id: currentSelectedVariantId,
                        quantity: qty
                    })
                });

                const data = await res.json();
                if (data.success) {
                    closeQuickAddModal();
                    if (redirectToCheckout) {
                        window.location.href = '{{ route("checkout.index") }}';
                    } else {
                        renderCartDrawer(data);
                        openCartDrawer();
                    }
                } else {
                    showToast('error', data.message || 'Error adding item.');
                }
            } catch (err) {
                console.error('Quick Add error:', err);
                showToast('error', 'Network error. Please try again.');
            } finally {
                addBtn.disabled = false;
                addBtn.innerHTML = originalText;
            }
        }
    </script>
    @yield('scripts')
</body>

</html>

