<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GlamGo - Beauty Salon')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('head')
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    
    <!-- Include Header -->
    @include('components.header')

    <main class="pt-32 pb-16">
        @yield('content')
    </main>

    <!-- Include Footer -->
    @include('components.footer')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    @yield('scripts')
</body>
</html>
