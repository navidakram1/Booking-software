<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'GlamGo') }} - {{ $title ?? 'Modern Salon Booking' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Styles -->
    @stack('styles')
    @livewireStyles
</head>
<body class="font-sans antialiased min-h-screen bg-gray-50">
    <!-- Header -->
    <x-layout.header :is-fixed="$isFixedHeader ?? true" />

    <!-- Main Content -->
    <main class="{{ ($isFixedHeader ?? true) ? 'pt-24' : '' }}">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-layout.footer :show_newsletter="$showNewsletter ?? true" />

    <!-- Scripts -->
    @stack('scripts')
    @livewireScripts

    <script>
        // Add CSRF token to all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>
