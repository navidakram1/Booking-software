<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GlamGo - Beauty Salon')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cover bg-center min-h-screen" style="background-image: url('/images/hero-bg-pattern.svg');">
    <!-- Header -->
    <x-layout.header />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-layout.footer :show_newsletter="true" />

    @stack('scripts')
</body>
</html>
