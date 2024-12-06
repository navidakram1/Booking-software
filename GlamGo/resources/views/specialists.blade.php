<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Specialists - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    @include('partials.header')

    <main class="pt-32 pb-20 px-4">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Meet Our Expert Team</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Our talented team of beauty professionals is dedicated to making you look and feel your best.</p>
        </section>

        <!-- Specialists Grid -->
        <section class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Specialist Card 1 -->
                <div class="specialist-card rounded-2xl p-6 text-center">
                    <div class="relative mb-6 group">
                        <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Sarah Johnson" class="w-48 h-48 rounded-full mx-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-purple-600/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Sarah Johnson</h3>
                    <p class="text-pink-500 font-medium mb-4">Senior Hair Stylist</p>
                    <p class="text-gray-600 mb-6">Specializing in creative cuts and color transformations with over 8 years of experience.</p>
                    <div class="flex justify-center space-x-4 mb-6">
                        <div class="flex items-center space-x-1">
                            <lord-icon src="https://cdn.lordicon.com/mdgrhyca.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:20px;height:20px"></lord-icon>
                            <span class="text-gray-600">Hair Styling</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <lord-icon src="https://cdn.lordicon.com/dqxvvqzi.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:20px;height:20px"></lord-icon>
                            <span class="text-gray-600">Coloring</span>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                        Book Appointment
                    </button>
                </div>

                <!-- Specialist Card 2 -->
                <div class="specialist-card rounded-2xl p-6 text-center">
                    <div class="relative mb-6 group">
                        <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Emily Chen" class="w-48 h-48 rounded-full mx-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-purple-600/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Emily Chen</h3>
                    <p class="text-pink-500 font-medium mb-4">Makeup Artist</p>
                    <p class="text-gray-600 mb-6">Expert in bridal makeup and special occasion looks with attention to detail.</p>
                    <div class="flex justify-center space-x-4 mb-6">
                        <div class="flex items-center space-x-1">
                            <lord-icon src="https://cdn.lordicon.com/rjzlnunf.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:20px;height:20px"></lord-icon>
                            <span class="text-gray-600">Makeup</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <lord-icon src="https://cdn.lordicon.com/hdiorcun.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:20px;height:20px"></lord-icon>
                            <span class="text-gray-600">Skincare</span>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                        Book Appointment
                    </button>
                </div>

                <!-- Specialist Card 3 -->
                <div class="specialist-card rounded-2xl p-6 text-center">
                    <div class="relative mb-6 group">
                        <img src="https://randomuser.me/api/portraits/women/3.jpg" alt="Maria Rodriguez" class="w-48 h-48 rounded-full mx-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-purple-600/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Maria Rodriguez</h3>
                    <p class="text-pink-500 font-medium mb-4">Nail Artist</p>
                    <p class="text-gray-600 mb-6">Creating stunning nail art and providing luxurious manicure experiences.</p>
                    <div class="flex justify-center space-x-4 mb-6">
                        <div class="flex items-center space-x-1">
                            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:20px;height:20px"></lord-icon>
                            <span class="text-gray-600">Manicure</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <lord-icon src="https://cdn.lordicon.com/rjzlnunf.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:20px;height:20px"></lord-icon>
                            <span class="text-gray-600">Nail Art</span>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                        Book Appointment
                    </button>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="max-w-7xl mx-auto mt-20">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">What Our Clients Say</h2>
            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper pb-8">
                    <!-- Testimonial 1 -->
                    <div class="swiper-slide">
                        <div class="specialist-card rounded-2xl p-6">
                            <div class="flex items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Client" class="w-12 h-12 rounded-full">
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-800">Jessica Williams</h4>
                                    <p class="text-gray-500 text-sm">Regular Client</p>
                                </div>
                            </div>
                            <p class="text-gray-600">"Sarah is amazing! She understood exactly what I wanted and gave me the perfect haircut. Highly recommend!"</p>
                        </div>
                    </div>
                    <!-- Add more testimonials -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .specialist-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }
        .specialist-card:hover {
            transform: translateY(-4px);
        }
    </style>

    <script>
        // Initialize Swiper
        new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
</body>
</html>
