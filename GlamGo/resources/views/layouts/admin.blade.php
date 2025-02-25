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
                        <a href="{{ route('admin.services.packages.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Service Packages</a>
                        <a href="{{ route('admin.services.addons.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Add-ons</a>
                        <a href="{{ route('admin.services.pricing') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Pricing Rules</a>
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
                        <a href="{{ route('admin.marketing.email') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Email Campaigns</a>
                        <a href="{{ route('admin.marketing.sms') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">SMS Marketing</a>
                        <a href="{{ route('admin.marketing.promotions') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Promotions</a>
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
                            <a href="{{ route('admin.revenue') }}" 
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.revenue') ? 'bg-gray-100' : '' }}">
                                <i class="fas fa-chart-line mr-3"></i>
                                Revenue Analytics
                            </a>
                            <a href="{{ route('admin.bookings') }}"
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.bookings') ? 'bg-gray-100' : '' }}">
                                <i class="fas fa-calendar-check mr-3"></i>
                                Bookings Analytics
                            </a>
                            <a href="{{ route('admin.customers') }}"
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.customers') ? 'bg-gray-100' : '' }}">
                                <i class="fas fa-users mr-3"></i>
                                Customer Analytics
                            </a>
                            <a href="{{ route('admin.services') }}"
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.services') ? 'bg-gray-100' : '' }}">
                                <i class="fas fa-concierge-bell mr-3"></i>
                                Service Analytics
                            </a>
                            <a href="{{ route('admin.staff') }}"
                                class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.staff') ? 'bg-gray-100' : '' }}">
                                <i class="fas fa-user-tie mr-3"></i>
                                Staff Analytics
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
                        <a href="{{ route('admin.content.pages') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Pages</a>
                        <a href="{{ route('admin.content.blog') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Blog</a>
                        <a href="{{ route('admin.content.gallery') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Gallery</a>
                        <a href="{{ route('admin.content.testimonials') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500 rounded-lg">Testimonials</a>
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
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Settings</a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-500">Logout</button>
                                </form>
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
