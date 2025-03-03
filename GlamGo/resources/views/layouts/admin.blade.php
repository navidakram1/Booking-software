<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - GlamGo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen font-[Poppins]" x-data="{ sidebarOpen: true }">
    <!-- Mobile Sidebar Toggle -->
    <div class="fixed top-4 left-4 z-50 lg:hidden">
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 bg-white rounded-lg shadow-lg">
            <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#121331" style="width:24px;height:24px"></lord-icon>
        </button>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg overflow-y-auto transform lg:transform-none lg:opacity-100 transition-all duration-300"
               :class="{'translate-x-0 opacity-100': sidebarOpen, '-translate-x-full opacity-0': !sidebarOpen}">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b">
                <span class="text-xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo Admin</span>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200 mb-2">
                    <lord-icon src="https://cdn.lordicon.com/gqdnbnwt.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                    <span class="mx-3">Dashboard</span>
                </a>

                <!-- Appointments -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Appointments</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.appointments.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">All Appointments</a>
                        <a href="{{ route('admin.appointments.calendar') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Calendar</a>
                        <a href="{{ route('admin.group-bookings.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('admin.group-bookings.*') ? 'text-pink-500 bg-pink-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg transition-colors duration-200">
                            <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:{{ request()->routeIs('admin.group-bookings.*') ? '#ec4899' : '#4b5563' }}" style="width:20px;height:20px"></lord-icon>
                            <span class="ml-3">Group Bookings</span>
                        </a>
                        <a href="{{ route('admin.waitlist.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Waitlist</a>
                        <a href="{{ route('admin.booking-rules.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Booking Rules</a>
                    </div>
                </div>

                <!-- Services -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/zvllgyec.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Services</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.services.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">All Services</a>
                        <a href="{{ route('admin.service-packages.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Service Packages</a>
                        <a href="{{ route('admin.service-addons.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Add-ons</a>
                        <a href="{{ route('admin.service-pricing.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Pricing Rules</a>
                    </div>
                </div>

                <!-- Staff -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Staff</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.staff.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">All Staff</a>
                        <a href="{{ route('admin.staff.create') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Add Staff</a>
                    </div>
                </div>

                <!-- Customers -->
                <a href="{{ route('admin.customers.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200 mb-2">
                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                    <span class="mx-3">Customers</span>
                </a>

                <!-- Marketing -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/ofwxqhyz.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Marketing</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.marketing.email') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Email Marketing</a>
                        <a href="{{ route('admin.marketing.sms') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">SMS Marketing</a>
                        <a href="{{ route('admin.marketing.campaigns') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Campaigns</a>
                    </div>
                </div>

                <!-- Reports -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/gqdnbnwt.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Reports</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.reports.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">General Reports</a>
                        <div class="space-y-2">
                            <h3 class="text-lg font-semibold text-gray-700">Analytics</h3>
                            <a href="{{ route('admin.revenue.index') }}" 
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.revenue.*') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="mx-4 font-medium">Revenue</span>
                            </a>
                            <a href="{{ route('admin.bookings.index') }}" 
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="mx-4 font-medium">Bookings Analytics</span>
                            </a>
                            <a href="{{ route('admin.customers.index') }}" 
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.customers.*') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="mx-4 font-medium">Customers</span>
                            </a>
                            <a href="{{ route('admin.staff.index') }}" 
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.staff.*') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="mx-4 font-medium">Staff</span>
                            </a>
                            <a href="{{ route('admin.services.index') }}" 
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span class="mx-4 font-medium">Services</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Content</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.content.pages.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Pages</a>
                        <a href="{{ route('admin.content.blog.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Blog</a>
                        <a href="{{ route('admin.content.gallery.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Gallery</a>
                        <a href="{{ route('admin.content.testimonials.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Testimonials</a>
                    </div>
                </div>

                <!-- Settings -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <lord-icon src="https://cdn.lordicon.com/hwuyodym.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                            <span class="mx-3">Settings</span>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="mt-2 pl-12 space-y-2">
                        <a href="{{ route('admin.settings.general') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">General</a>
                        <a href="{{ route('admin.settings.notifications') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Notifications</a>
                        <a href="{{ route('admin.settings.integrations') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Integrations</a>
                        <a href="{{ route('admin.settings.payment') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Payment</a>
                        <a href="{{ route('admin.settings.security') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Security</a>
                    </div>
                </div>

                <!-- Cache -->
                <a href="{{ route('admin.cache') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 rounded-lg transition-all duration-200">
                    <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                    <span class="mx-3">Cache Management</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-0 lg:ml-64 min-h-screen p-4 lg:p-8">
            <!-- Top Bar -->
            <div class="bg-white rounded-2xl p-4 mb-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="p-2 text-gray-600 hover:text-pink-500 transition-colors duration-200">
                            <lord-icon src="https://cdn.lordicon.com/psnhyobz.json" trigger="hover" colors="primary:#ec4899" style="width:24px;height:24px"></lord-icon>
                        </button>
                        <!-- Profile -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center">
                                    <span class="text-pink-600 font-medium">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                                </div>
                            </button>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                                <div class="mt-3 space-y-1">
                                    <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Settings</a>
                                    <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="space-y-6">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
