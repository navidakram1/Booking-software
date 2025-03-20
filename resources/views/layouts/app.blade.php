<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'GlamGo'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-8">
                    </a>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-primary-600 transition-colors">Services</a>
                        <a href="{{ route('specialists.index') }}" class="text-gray-700 hover:text-primary-600 transition-colors">Specialists</a>
                        <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-primary-600 transition-colors">Gallery</a>
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary-600 transition-colors">About</a>
                        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-primary-600 transition-colors">Contact</a>
                    </div>

                    <!-- Auth/User Menu -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-gray-700 hover:text-primary-600 transition-colors">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('profile.edit') }}">
                                        Profile
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('bookings.index') }}">
                                        My Bookings
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors">Register</a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button type="button" class="text-gray-700" @click="mobileMenuOpen = !mobileMenuOpen">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden" x-show="mobileMenuOpen" x-transition>
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('services.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-100">Services</a>
                    <a href="{{ route('specialists.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-100">Specialists</a>
                    <a href="{{ route('gallery') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-100">Gallery</a>
                    <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-100">About</a>
                    <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-100">Contact</a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>
</html> 