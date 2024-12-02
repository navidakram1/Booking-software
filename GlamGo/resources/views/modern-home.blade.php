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
        <section class="relative min-h-screen overflow-hidden">
            <!-- Background Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent"></div>

            <!-- Hero Image - Positioned Behind -->
            <div class="absolute inset-0 flex justify-end items-start">
                <img src="{{ asset('images/Hero.png') }}" 
                     alt="Glamorous salon professional" 
                     class="w-auto h-[150%] max-w-none object-contain object-right-top transform translate-y-[-10%] translate-x-[15%]">
            </div>

            <!-- Content -->
            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 h-screen flex items-center">
                <div class="max-w-2xl space-y-8">
                    <div class="space-y-6">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white [text-shadow:_0_1px_12px_rgb(0_0_0_/_20%)]">
                            Your Beauty<br/>
                            <span class="bg-gradient-to-r from-pink-300 to-purple-300 bg-clip-text text-transparent">Journey</span><br/>
                            Starts Here
                        </h1>
                        <p class="text-gray-200 text-lg sm:text-xl [text-shadow:_0_1px_8px_rgb(0_0_0_/_20%)]">
                            Experience luxury beauty services with our expert stylists. Step into a world of elegance and transformation.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <button class="group px-8 py-4 bg-white/20 backdrop-blur-md text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-lg font-semibold border border-white/30 hover:bg-white/30">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Book Appointment</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </button>
                        <button class="group px-8 py-4 bg-white/10 backdrop-blur-md text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-lg font-semibold border border-white/20 hover:bg-white/20">
                            <span class="flex items-center justify-center space-x-2">
                                <span>View Services</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-24 bg-gradient-to-b from-[#A94CA5] to-[#8A3B87]">
            <div class="container mx-auto px-4">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-bold text-white mb-4">Our Services</h2>
                    <p class="text-white/80 text-lg max-w-2xl mx-auto">Experience luxury hair care with our premium salon services</p>
                </div>
                
                <!-- Services Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Service Card 1 -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transition-all duration-300 hover:transform hover:scale-105 hover:bg-white/20">
                        <div class="text-white mb-4">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Haircut & Styling</h3>
                        <p class="text-white/80 mb-4">Professional cut and style tailored to your preferences</p>
                        <div class="flex justify-between items-center">
                            <span class="text-white font-bold text-2xl">$75</span>
                            <button class="px-4 py-2 bg-white text-[#A94CA5] rounded-xl font-medium hover:bg-white/90 transition-colors">Book Now</button>
                        </div>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transition-all duration-300 hover:transform hover:scale-105 hover:bg-white/20">
                        <div class="text-white mb-4">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.38 8.57l-1.23 1.85a8 8 0 0 1-.22 7.58H5.07A8 8 0 0 1 15.58 6.85l1.85-1.23A10 10 0 0 0 3.35 19a2 2 0 0 0 1.72 1h13.85a2 2 0 0 0 1.74-1 10 10 0 0 0-.27-10.44z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Hair Coloring</h3>
                        <p class="text-white/80 mb-4">Premium color treatments and highlights</p>
                        <div class="flex justify-between items-center">
                            <span class="text-white font-bold text-2xl">$120</span>
                            <button class="px-4 py-2 bg-white text-[#A94CA5] rounded-xl font-medium hover:bg-white/90 transition-colors">Book Now</button>
                        </div>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transition-all duration-300 hover:transform hover:scale-105 hover:bg-white/20">
                        <div class="text-white mb-4">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3c5.5 0 10 4.5 10 10s-4.5 10-10 10S2 18.5 2 13 6.5 3 12 3m0 2c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Hair Treatment</h3>
                        <p class="text-white/80 mb-4">Revitalizing treatments for healthy, shiny hair</p>
                        <div class="flex justify-between items-center">
                            <span class="text-white font-bold text-2xl">$95</span>
                            <button class="px-4 py-2 bg-white text-[#A94CA5] rounded-xl font-medium hover:bg-white/90 transition-colors">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
