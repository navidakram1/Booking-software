<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    
    <!-- Include Header -->
    @include('components.header')

    <main class="pt-32 pb-16">
        <!-- Hero Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">Book Your Appointment</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Schedule your beauty session with our expert specialists</p>
            </div>
        </section>

        <!-- Booking Section -->
        @include('components.booking-section')
    </main>

    <!-- Include Footer -->
    @include('components.footer')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</body>
</html>
