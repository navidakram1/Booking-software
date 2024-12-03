<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamGo - Modern Salon Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    <!-- Navigation Header -->
    <header class="fixed w-full top-0 z-50">
        <nav class="nav-blur mx-auto max-w-5xl mt-3 sm:mt-4 md:mt-6 px-4 sm:px-6 py-2 rounded-full transition-all duration-300">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <div class="flex items-center space-x-1.5 sm:space-x-2">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs sm:text-sm font-bold">G</span>
                        </div>
                        <span class="text-base sm:text-lg font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</span>
                    </div>
                </div>

                <!-- Navigation Links - Hidden on Mobile -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="#" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Home</span>
                    </a>
                    <a href="#services" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmlleaaf.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Services</span>
                    </a>
                    <a href="#specialists" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/ktsahwvc.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Specialists</span>
                    </a>
                    <a href="#about" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>About</span>
                    </a>
                    <a href="#contact" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/diihvcfp.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Contact</span>
                    </a>
                </div>

                <!-- Right Side Navigation -->
                <div class="flex items-center space-x-1.5 sm:space-x-2">
                    <!-- Book Now Button -->
                    <button class="hidden md:flex px-3 lg:px-4 py-1.5 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs lg:text-sm rounded-full shadow-md hover:shadow-lg transition-all duration-300 items-center justify-center">
                        Book Now
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Items -->
            <div id="mobile-menu" class="md:hidden mt-4 hidden opacity-0 transition-all duration-300 transform -translate-y-2">
                <div class="flex flex-col space-y-2 bg-white/90 backdrop-blur-sm rounded-2xl p-3 border border-gray-100 shadow-lg">
                    <a href="#" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Home</span>
                    </a>
                    <!-- More mobile menu items... -->
                </div>
            </div>
        </nav>
    </header>

    <style>
        .nav-blur {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .specialist-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .specialist-card:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.15);
        }
        .booking-form {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        main section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
    </style>

    <main class="pt-24">
        <!-- Hero Section -->
        <section class="relative min-h-screen pt-16 overflow-hidden">
            <!-- SVG Pattern Background - No overlay -->
            <img src="{{ asset('images/hero-bg-pattern.svg') }}" 
                 class="absolute inset-0 w-full h-full object-cover">

            <!-- Hero Content -->
            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 min-h-[calc(100vh-4rem)]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 h-full items-center">
                    <!-- Left Content -->
                    <div class="max-w-2xl space-y-8 pt-12 lg:pt-0">
                        <div class="space-y-6">
                            <h2 class="text-gray-600 font-medium text-xl tracking-wider">WELCOME TO GLAMGO</h2>
                            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800">
                                Transform Your<br/>
                                <span class="bg-gradient-to-r from-purple-500 to-pink-500 bg-clip-text text-transparent">Style & Beauty</span><br/>
                                With Confidence
                            </h1>
                            <p class="text-gray-600 text-lg sm:text-xl max-w-xl">
                                Discover a world of premium beauty services tailored to enhance your unique style. Our expert stylists are here to bring your vision to life.
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <button class="group px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-lg font-semibold hover:scale-105">
                                <span class="flex items-center justify-center space-x-2">
                                    <span>Book Your Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </button>
                            <button class="group px-8 py-4 bg-white/70 backdrop-blur-sm text-gray-700 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-lg font-semibold border border-purple-100 hover:bg-white">
                                <span class="flex items-center justify-center space-x-2">
                                    <span>Explore Services</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Hero Image - Right Column -->
                    <div class="relative h-[calc(100vh-4rem)] flex items-center justify-center lg:justify-end">
                        <img src="{{ asset('images/Hero.png') }}" 
                             alt="Glamorous salon professional" 
                             class="object-cover h-[90%] w-auto max-w-none lg:scale-125 lg:translate-x-20">
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        @include('components.services-section')

        <!-- Live Queue Section -->
        @include('components.live-queue-section')

        <!-- Specialists Section -->
        @include('components.specialists-section')

        <!-- Promotional Offers Section -->
        @include('components.promotional-offers-section')

        <!-- Testimonials Section -->
        @include('components.testimonials-section')

        <!-- Availability Section -->
        @include('components.availability-section')

        <!-- Booking Section -->
        @include('components.booking-section')

        <!-- Contact Section -->
        @include('components.contact-section')

        <!-- FAQ Section -->
        @include('components.faq-section')

        <!-- Footer Section -->
        @include('components.footer-section')
    </main>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                setTimeout(() => {
                    mobileMenu.classList.toggle('opacity-0');
                    mobileMenu.classList.toggle('-translate-y-2');
                }, 20);
            });
        });
    </script>
</body>
</html>
