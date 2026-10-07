<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Portal') | Coffee Base Philippines</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        adminbg: '#0f1713',
                        adminsidebar: '#14221b',
                        admincard: '#1b2d24',
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
                        sans: ['"Plus Jakarta Sans"', '"Inter"', 'sans-serif'],
                        serif: ['"Plus Jakarta Sans"', '"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #f6f5f0;
            color: #243026;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        /* Matcha Theme SweetAlert2 Toast */
        .coffeebase-toast-popup {
            background: #1b2c21 !important;
            color: #fbfaf2 !important;
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
            background: #dcb35c !important;
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

        /* DataTables Admin Styling */
        .dataTables_wrapper {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-size: 0.8125rem;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1.25rem;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.4rem 2rem 0.4rem 0.75rem;
            border: 1px solid #e7e5e4;
            border-radius: 0.75rem;
            outline: none;
            font-size: 0.75rem;
            background-color: #fff;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #3d664a;
            box-shadow: 0 0 0 1px #3d664a;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 0.45rem 0.85rem;
            border: 1px solid #e7e5e4;
            border-radius: 0.75rem;
            outline: none;
            font-size: 0.75rem;
            margin-left: 0.5rem;
            background-color: #fff;
            min-width: 220px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3d664a;
            box-shadow: 0 0 0 1px #3d664a;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 1.25rem;
            color: #78716c;
            font-size: 0.75rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.35rem 0.75rem !important;
            border-radius: 0.5rem !important;
            border: 1px solid #e7e5e4 !important;
            background: #fff !important;
            color: #292524 !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f5f5f4 !important;
            border-color: #d6d3d1 !important;
            color: #0c0a09 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #284131 !important;
            border-color: #284131 !important;
            color: #fbfaf2 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Custom Premium DataTables Sorting Icons & Header Styling */
        table.dataTable thead th {
            position: relative;
            cursor: pointer;
            user-select: none;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        table.dataTable thead th:hover {
            background-color: #eef3ee !important;
            color: #1b2c21 !important;
        }

        table.dataTable thead th.sorting,
        table.dataTable thead th.sorting_asc,
        table.dataTable thead th.sorting_desc {
            padding-right: 2rem !important;
        }

        table.dataTable thead th.sorting::after,
        table.dataTable thead th.sorting_asc::after,
        table.dataTable thead th.sorting_desc::after {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            content: '';
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.9;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        /* Inactive sorting - dual crisp chevrons */
        table.dataTable thead th.sorting::after {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%23a8a29e'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9' /%3E%3C/svg%3E");
            opacity: 0.65;
        }

        table.dataTable thead th.sorting:hover::after {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%233d664a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9' /%3E%3C/svg%3E");
            opacity: 1;
        }

        /* Active Ascending (Up Chevron - Matcha Green #1b2c21) */
        table.dataTable thead th.sorting_asc {
            background-color: #ebf2ec !important;
            color: #1b2c21 !important;
            font-weight: 800 !important;
        }

        table.dataTable thead th.sorting_asc::after {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='3.2' stroke='%231b2c21'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M4.5 15.75l7.5-7.5 7.5 7.5' /%3E%3C/svg%3E");
            opacity: 1;
            filter: drop-shadow(0px 1px 2px rgba(27, 44, 33, 0.3));
        }

        /* Active Descending (Down Chevron - Matcha Green #1b2c21) */
        table.dataTable thead th.sorting_desc {
            background-color: #ebf2ec !important;
            color: #1b2c21 !important;
            font-weight: 800 !important;
        }

        table.dataTable thead th.sorting_desc::after {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='3.2' stroke='%231b2c21'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
            opacity: 1;
            filter: drop-shadow(0px 1px 2px rgba(27, 44, 33, 0.3));
        }

        /* Disabled sorting columns (like Actions) */
        table.dataTable thead th.sorting_disabled,
        table.dataTable thead th.no-sort {
            cursor: default !important;
            padding-right: 1rem !important;
        }

        table.dataTable thead th.sorting_disabled:hover,
        table.dataTable thead th.no-sort:hover {
            background-color: transparent !important;
        }

        table.dataTable thead th.sorting_disabled::after,
        table.dataTable thead th.no-sort::after {
            display: none !important;
            content: none !important;
        }
    </style>
</head>

<body class="bg-[#f6f5f0] text-stone-800 antialiased font-sans min-h-screen flex">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="admin-sidebar-backdrop" onclick="toggleAdminSidebar()"
        class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs z-40 hidden md:hidden transition-opacity"></div>

    <!-- Admin Sidebar -->
    <aside id="admin-sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-adminsidebar text-stone-300 flex flex-col justify-between border-r border-stone-800/80 min-h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out md:static md:z-auto">
        <div>
            <!-- Brand -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-matcha-900/80 bg-adminbg/80">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div
                        class="w-9 h-9 rounded-xl bg-matcha-700 text-gold-400 flex items-center justify-center font-bold text-sm shadow-inner border border-matcha-600">
                        CB
                    </div>
                    <div>
                        <h1 class="text-xs font-bold text-white tracking-wider uppercase font-sans">Coffee Base</h1>
                        <span class="text-[9px] tracking-widest text-gold-400 uppercase font-semibold block">Admin
                            Portal</span>
                    </div>
                </a>

                <!-- Mobile Close Button -->
                <button type="button" onclick="toggleAdminSidebar()"
                    class="md:hidden text-stone-400 hover:text-white p-1">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-xs font-medium uppercase tracking-wider">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3.5 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-matcha-700 text-white shadow-md font-semibold' : 'text-stone-400 hover:bg-stone-800/60 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 mr-3 text-gold-400"></i>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-stone-500 tracking-widest uppercase">Catalog
                    Management</div>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-matcha-700 text-white shadow-md font-semibold' : 'text-stone-400 hover:bg-stone-800/60 hover:text-white' }}">
                    <i data-lucide="folder-tree" class="w-4 h-4 mr-3"></i>
                    <span>Matcha Categories</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-matcha-700 text-white shadow-md font-semibold' : 'text-stone-400 hover:bg-stone-800/60 hover:text-white' }}">
                    <i data-lucide="package-search" class="w-4 h-4 mr-3"></i>
                    <span>Products & Pricing</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-stone-500 tracking-widest uppercase">Sales &
                    Fulfillment</div>

                @php
                    $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                    $unreadMsg = \App\Models\ContactMessage::where('status', 'unread')->count();
                @endphp

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-matcha-700 text-white shadow-md font-semibold' : 'text-stone-400 hover:bg-stone-800/60 hover:text-white' }}">
                    <div class="flex items-center">
                        <i data-lucide="shopping-cart" class="w-4 h-4 mr-3"></i>
                        <span>Orders & Delivery</span>
                    </div>
                    @if ($pendingCount > 0)
                        <span
                            class="bg-amber-500 text-stone-950 text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-stone-500 tracking-widest uppercase">CRM &
                    Operations</div>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-matcha-700 text-white shadow-md font-semibold' : 'text-stone-400 hover:bg-stone-800/60 hover:text-white' }}">
                    <i data-lucide="users" class="w-4 h-4 mr-3"></i>
                    <span>User Management</span>
                </a>

                {{-- <a href="{{ route('admin.contacts.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.contacts.*') ? 'bg-matcha-700 text-white shadow-md font-semibold' : 'text-stone-400 hover:bg-stone-800/60 hover:text-white' }}">
                    <div class="flex items-center">
                        <i data-lucide="message-square" class="w-4 h-4 mr-3"></i>
                        <span>Contact Messages</span>
                    </div>
                    @if ($unreadMsg > 0)
                        <span class="bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                            {{ $unreadMsg }}
                        </span>
                    @endif
                </a> --}}
            </nav>
        </div>

        <!-- Sidebar Bottom Footer -->
        <div class="p-4 border-t border-matcha-900 bg-adminbg/40">
            <a href="{{ route('home') }}" target="_blank"
                class="flex items-center justify-center space-x-2 w-full py-2.5 px-3 rounded-xl text-xs font-semibold uppercase tracking-wider bg-stone-800/80 text-cream-200 hover:bg-stone-700 transition-colors">
                <i data-lucide="external-link" class="w-3.5 h-3.5 text-gold-400"></i>
                <span>View Live Store</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden min-w-0">

        <!-- Admin Topbar -->
        <header
            class="h-20 bg-white border-b border-stone-200/90 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center space-x-3">
                <!-- Mobile Hamburger Button -->
                <button type="button" onclick="toggleAdminSidebar()"
                    class="md:hidden p-2 text-stone-700 hover:bg-stone-100 rounded-lg transition-colors">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h2 class="text-base sm:text-lg font-bold text-stone-900 tracking-tight">@yield('page_title', 'Dashboard Overview')</h2>
            </div>

            <!-- Topbar Right Actions & User Profile -->
            <div class="flex items-center space-x-4 sm:space-x-6">
                <!-- User Profile & Logout -->
                <div class="flex items-center space-x-3">
                    <button type="button" onclick="openAdminProfileModal()"
                        class="flex items-center space-x-2.5 p-1.5 -m-1.5 rounded-2xl hover:bg-stone-100 transition-all text-left group focus:outline-none focus:ring-2 focus:ring-matcha-600/30"
                        title="Click to edit profile & account details">
                        <div
                            class="w-9 h-9 rounded-full bg-matcha-700 text-cream-50 flex items-center justify-center font-bold text-xs shadow-xs group-hover:bg-matcha-800 transition-colors">
                            {{ strtoupper(substr(auth()->user()->first_name ?: auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?: explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) ?: 'D' }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="flex items-center gap-1">
                                <p
                                    class="font-bold text-stone-950 text-xs leading-tight group-hover:text-matcha-900 transition-colors">
                                    {{ auth()->user()->name ?? 'Coffee Base Admin' }}</p>
                                <i data-lucide="chevron-down"
                                    class="w-3 h-3 text-stone-400 group-hover:text-stone-700 transition-colors"></i>
                            </div>
                            <span class="text-[9px] font-bold text-amber-700 tracking-wider uppercase block">SUPER
                                ADMIN</span>
                        </div>
                    </button>

                    <!-- Logout Form Icon -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-stone-400 hover:text-rose-600 p-2 rounded-lg hover:bg-stone-100 transition-colors"
                            title="Logout">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- ADMIN PROFILE MODAL -->
        <div id="admin-profile-modal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300"
            role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity cursor-pointer"
                onclick="closeAdminProfileModal()"></div>
            <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 overflow-hidden"
                id="admin-profile-card">
                <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-matcha-700 text-cream-50 flex items-center justify-center font-bold text-sm shadow-xs">
                            {{ strtoupper(substr(auth()->user()->first_name ?: auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?: explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) ?: 'D' }}
                        </div>
                        <div>
                            <h3 class="text-base font-sans font-bold text-stone-950">Admin Profile & Security</h3>
                            <p class="text-xs text-stone-500">Manage your personal admin account and password</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeAdminProfileModal()"
                        class="text-stone-400 hover:text-stone-700 p-1.5 rounded-full hover:bg-stone-100 transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4 pt-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">First
                                Name *</label>
                            <input type="text" name="first_name"
                                value="{{ old('first_name', auth()->user()->first_name ?: explode(' ', auth()->user()->name)[0]) }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Last
                                Name *</label>
                            <input type="text" name="last_name"
                                value="{{ old('last_name', auth()->user()->last_name ?: explode(' ', auth()->user()->name)[1] ?? '') }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email
                                Address *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Phone
                                Number</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                placeholder="0917 123 4567"
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Company
                                / Organization</label>
                            <input type="text" name="company"
                                value="{{ old('company', auth()->user()->company) }}" placeholder="Coffee Base Ph"
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">City
                                / Location</label>
                            <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}"
                                placeholder="Metro Manila"
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <!-- Change Password Section -->
                    <div class="pt-3 border-t border-stone-200">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-stone-800">Change
                                Password</span>
                            <span class="text-[10px] text-stone-400 font-medium">Leave blank if no change</span>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-[11px] font-semibold text-stone-600 mb-1">Current Password
                                    (Required only if changing password)</label>
                                <input type="password" name="current_password" placeholder="Enter current password"
                                    class="w-full px-4 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-stone-600 mb-1">New
                                        Password</label>
                                    <input type="password" name="password" placeholder="Min 6 characters"
                                        class="w-full px-4 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-stone-600 mb-1">Confirm New
                                        Password</label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Repeat new password"
                                        class="w-full px-4 py-2 rounded-xl border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-stone-100 flex items-center justify-end space-x-3">
                        <button type="button" onclick="closeAdminProfileModal()"
                            class="px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-600 hover:bg-stone-100 rounded-xl transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Global SweetAlert2 Toast Triggers -->
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

        <!-- Main Body -->
        <div class="p-4 sm:p-8 flex-1">
            @yield('content')
        </div>
    </div>

    <script>
        lucide.createIcons();

        // SweetAlert2 Toast Mixin for Admin
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
                icon: icon,
                title: title,
                text: text
            });
        }

        // Mobile Sidebar Toggle
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('admin-sidebar-backdrop');

            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Admin Profile Modal Toggle
        function openAdminProfileModal() {
            const modal = document.getElementById('admin-profile-modal');
            const card = document.getElementById('admin-profile-card');
            if (modal && card) {
                modal.classList.remove('pointer-events-none', 'opacity-0');
                modal.classList.add('pointer-events-auto', 'opacity-100');
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
            }
        }

        function closeAdminProfileModal() {
            const modal = document.getElementById('admin-profile-modal');
            const card = document.getElementById('admin-profile-card');
            if (modal && card) {
                card.classList.remove('scale-100');
                card.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.remove('pointer-events-auto', 'opacity-100');
                    modal.classList.add('pointer-events-none', 'opacity-0');
                }, 200);
            }
        }
    </script>
    @yield('scripts')
    @stack('scripts')
</body>

</html>
