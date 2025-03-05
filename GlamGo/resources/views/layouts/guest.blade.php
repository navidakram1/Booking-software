<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-cover bg-center min-h-screen" style="background-image: url('/images/hero-bg-pattern.svg');">
        <!-- Header -->
        <x-layout.header :isFixed="false" />

        <!-- Main Content -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-24 sm:pt-32 pb-12">
            <div>
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">G</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/80 backdrop-blur-xl shadow-lg overflow-hidden sm:rounded-2xl border border-white/20">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <x-layout.footer :show_newsletter="false" />

        @stack('scripts')
    </body>
</html>
