<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lightbox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    @include('partials.header')

    <main class="pt-32 pb-20 px-4">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Our Gallery</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Explore our collection of stunning transformations and beautiful styles created by our talented team.</p>
        </section>

        <!-- Filter Buttons -->
        <div class="max-w-7xl mx-auto mb-12">
            <div class="flex flex-wrap justify-center gap-4" x-data="{ activeFilter: 'all' }">
                <button @click="activeFilter = 'all'" 
                        :class="{ 'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeFilter === 'all', 'bg-white text-gray-700 hover:bg-gray-50': activeFilter !== 'all' }"
                        class="px-6 py-2 rounded-full transition-all duration-300">
                    All
                </button>
                <button @click="activeFilter = 'haircuts'" 
                        :class="{ 'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeFilter === 'haircuts', 'bg-white text-gray-700 hover:bg-gray-50': activeFilter !== 'haircuts' }"
                        class="px-6 py-2 rounded-full transition-all duration-300">
                    Haircuts
                </button>
                <button @click="activeFilter = 'coloring'" 
                        :class="{ 'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeFilter === 'coloring', 'bg-white text-gray-700 hover:bg-gray-50': activeFilter !== 'coloring' }"
                        class="px-6 py-2 rounded-full transition-all duration-300">
                    Coloring
                </button>
                <button @click="activeFilter = 'makeup'" 
                        :class="{ 'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeFilter === 'makeup', 'bg-white text-gray-700 hover:bg-gray-50': activeFilter !== 'makeup' }"
                        class="px-6 py-2 rounded-full transition-all duration-300">
                    Makeup
                </button>
                <button @click="activeFilter = 'nails'" 
                        :class="{ 'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeFilter === 'nails', 'bg-white text-gray-700 hover:bg-gray-50': activeFilter !== 'nails' }"
                        class="px-6 py-2 rounded-full transition-all duration-300">
                    Nails
                </button>
            </div>
        </div>

        <!-- Gallery Grid -->
        <section class="max-w-7xl mx-auto" x-data="{ activeFilter: 'all' }">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Gallery Item 1 -->
                <div class="gallery-card rounded-2xl overflow-hidden" x-show="activeFilter === 'all' || activeFilter === 'haircuts'">
                    <a href="https://source.unsplash.com/800x600/?haircut" data-lightbox="gallery" data-title="Modern Bob Cut">
                        <div class="relative group">
                            <img src="https://source.unsplash.com/800x600/?haircut" alt="Haircut" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                <div class="p-6">
                                    <h3 class="text-white text-xl font-bold">Modern Bob Cut</h3>
                                    <p class="text-gray-200">By Sarah Johnson</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Gallery Item 2 -->
                <div class="gallery-card rounded-2xl overflow-hidden" x-show="activeFilter === 'all' || activeFilter === 'coloring'">
                    <a href="https://source.unsplash.com/800x600/?haircolor" data-lightbox="gallery" data-title="Pastel Pink Transformation">
                        <div class="relative group">
                            <img src="https://source.unsplash.com/800x600/?haircolor" alt="Hair Coloring" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                <div class="p-6">
                                    <h3 class="text-white text-xl font-bold">Pastel Pink Transformation</h3>
                                    <p class="text-gray-200">By Emily Chen</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Gallery Item 3 -->
                <div class="gallery-card rounded-2xl overflow-hidden" x-show="activeFilter === 'all' || activeFilter === 'makeup'">
                    <a href="https://source.unsplash.com/800x600/?makeup" data-lightbox="gallery" data-title="Bridal Makeup">
                        <div class="relative group">
                            <img src="https://source.unsplash.com/800x600/?makeup" alt="Makeup" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                <div class="p-6">
                                    <h3 class="text-white text-xl font-bold">Bridal Makeup</h3>
                                    <p class="text-gray-200">By Maria Rodriguez</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Add more gallery items -->
            </div>
        </section>

        <!-- Before/After Section -->
        <section class="max-w-7xl mx-auto mt-20">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Transformations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Before/After Item 1 -->
                <div class="gallery-card rounded-2xl overflow-hidden">
                    <div class="relative">
                        <div class="grid grid-cols-2 gap-2">
                            <img src="https://source.unsplash.com/400x600/?before-haircut" alt="Before" class="w-full h-96 object-cover rounded-l-2xl">
                            <img src="https://source.unsplash.com/400x600/?after-haircut" alt="After" class="w-full h-96 object-cover rounded-r-2xl">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-6">
                                <h3 class="text-white text-xl font-bold">Complete Hair Transformation</h3>
                                <p class="text-gray-200">By Sarah Johnson</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more before/after items -->
            </div>
        </section>
    </main>

    @include('partials.footer')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gallery-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }
        .gallery-card:hover {
            transform: translateY(-4px);
        }
    </style>

    <script>
        // Initialize Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2'
        });
    </script>
</body>
</html>
