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
<body class="bg-gray-100 min-h-screen font-[Poppins]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg overflow-y-auto">
            <div class="flex items-center justify-center h-16 border-b">
                <span class="text-xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo Admin</span>
            </div>
            <nav class="mt-6">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                    <lord-icon src="https://cdn.lordicon.com/gqdnbnwt.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                    <span class="mx-3">Dashboard</span>
                </a>

                <!-- Booking Management -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Bookings</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.appointments.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Appointments</a>
                        <a href="{{ route('admin.group-bookings') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Group Bookings</a>
                        <a href="{{ route('admin.waitlist') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Waitlist</a>
                        <a href="{{ route('admin.booking-rules') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Booking Rules</a>
                    </div>
                </div>

                <!-- Service Management -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/zvllgyec.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Services</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.services.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">All Services</a>
                        <a href="{{ route('admin.services.packages') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Service Packages</a>
                        <a href="{{ route('admin.services.addons') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Add-ons</a>
                        <a href="{{ route('admin.services.pricing') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Pricing Rules</a>
                    </div>
                </div>

                <!-- Staff Management -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Staff</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.staff.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Staff List</a>
                        <a href="{{ route('admin.staff.shifts') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Shift Management</a>
                        <a href="{{ route('admin.staff.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Performance Overview</a>
                        <a href="{{ route('admin.staff.leave') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Leave Requests</a>
                    </div>
                </div>

                <!-- Customer Management -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Customers</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.customers.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Customer List</a>
                        <a href="{{ route('admin.customers.rewards') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Reward Points</a>
                        <a href="{{ route('admin.customers.reviews') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Reviews</a>
                        <a href="{{ route('admin.customers.import') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Import/Export</a>
                    </div>
                </div>

                <!-- Analytics -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/gqdnbnwt.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Analytics</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.analytics.retention') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Customer Retention</a>
                        <a href="{{ route('admin.analytics.revenue') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Revenue Reports</a>
                        <a href="{{ route('admin.analytics.trends') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Booking Trends</a>
                        <a href="{{ route('admin.analytics.abandoned') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Abandoned Bookings</a>
                    </div>
                </div>

                <!-- Marketing -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/ngcezuqf.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Marketing</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.marketing.campaigns') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Campaigns</a>
                        <a href="{{ route('admin.marketing.promotions') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Promotions</a>
                        <a href="{{ route('admin.marketing.affiliates') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Affiliates</a>
                        <a href="{{ route('admin.marketing.push') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Push Notifications</a>
                    </div>
                </div>

                <!-- Content -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Content</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.content.testimonials') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Testimonials</a>
                        <a href="{{ route('admin.content.team') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Team Spotlights</a>
                        <a href="{{ route('admin.content.events') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Events</a>
                        <a href="{{ route('admin.content.landing') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Landing Pages</a>
                    </div>
                </div>

                <!-- Settings -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-500 transition-all duration-200">
                        <lord-icon src="https://cdn.lordicon.com/hwuyodym.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        <span class="mx-3">Settings</span>
                        <lord-icon src="https://cdn.lordicon.com/xsdtfyne.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px" class="ml-auto transform" :class="{'rotate-180': open}"></lord-icon>
                    </button>
                    <div x-show="open" x-cloak class="pl-12 bg-gray-50">
                        <a href="{{ route('admin.settings.general') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">General</a>
                        <a href="{{ route('admin.settings.appearance') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Appearance</a>
                        <a href="{{ route('admin.settings.notifications') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Notifications</a>
                        <a href="{{ route('admin.settings.booking') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Booking</a>
                        <a href="{{ route('admin.settings.staff') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Staff</a>
                        <a href="{{ route('admin.settings.payments') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Payments</a>
                        <a href="{{ route('admin.settings.integrations') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-pink-500">Integrations</a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                            <lord-icon src="https://cdn.lordicon.com/psnhyobz.json" trigger="hover" colors="primary:#333" style="width:20px;height:20px"></lord-icon>
                            <span>Notifications</span>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2">
                            <div class="px-4 py-2 border-b">
                                <h3 class="font-medium">Notifications</h3>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                <!-- Notification Items -->
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                                    <p class="text-sm font-medium text-gray-900">New Booking</p>
                                    <p class="text-sm text-gray-500">John Doe booked a haircut</p>
                                    <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                                </a>
                                <!-- More notifications... -->
                            </div>
                            <div class="px-4 py-2 border-t">
                                <a href="#" class="text-sm text-pink-500 hover:text-pink-600">View All Notifications</a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#333" style="width:20px;height:20px"></lord-icon>
                            <span>Profile</span>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
