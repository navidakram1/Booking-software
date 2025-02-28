<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'GlamGo') }} - {{ $title ?? 'Modern Salon Booking' }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased min-h-screen bg-gray-50">
    <!-- Header -->
    <x-layout.header :is-fixed="$isFixedHeader ?? true" />

    <!-- Main Content -->
    <main class="{{ ($isFixedHeader ?? true) ? 'pt-24' : '' }}">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-layout.footer :show-newsletter="$showNewsletter ?? true" />

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
