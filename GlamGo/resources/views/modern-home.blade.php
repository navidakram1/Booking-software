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

    <main class="pt-0">
        <!-- Hero Section -->
        <section class="relative h-screen overflow-hidden">
            <!-- SVG Pattern Background - No overlay -->
            <img src="{{ asset('images/hero-bg-pattern.svg') }}" 
                 class="absolute inset-0 w-full h-full object-cover">

            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 h-screen flex items-center">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 h-full items-center pt-16">
                    <!-- Left Content -->
                    <div class="max-w-2xl space-y-8">
                        <div class="space-y-6">
                            <h2 class="text-gray-600 font-medium text-xl tracking-wider">WELCOME TO GLAMGO</h2>
                            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800">
                                Book Your Perfect Style Today
                            </h1>
                            <p class="text-gray-600 text-lg sm:text-xl">
                                Experience luxury hair care with our expert stylists
                            </p>
                        </div>

                        <!-- Combined Booking and Availability Section -->
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.12)] space-y-8 border border-white/20">
                            <div class="space-y-2">
                                <h3 class="text-2xl font-semibold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Book Your Service</h3>
                                <p class="text-gray-500 text-sm">Choose your preferred service and time</p>
                            </div>
                            
                            <!-- Service Selection -->
                            <div class="space-y-6">
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <span>Select Service</span>
                                    </label>
                                    <select class="form-select w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                        <option>Haircut & Styling</option>
                                        <option>Hair Coloring</option>
                                        <option>Spa Treatment</option>
                                        <option>Manicure & Pedicure</option>
                                        <option>Facial & Skincare</option>
                                        <option>Makeup Services</option>
                                    </select>
                                </div>

                                <!-- Date and Time Selection -->
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Date</span>
                                        </label>
                                        <input type="date" class="form-input w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Time</span>
                                        </label>
                                        <select class="form-select w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                            <option>9:00 AM</option>
                                            <option>10:00 AM</option>
                                            <option>11:00 AM</option>
                                            <option>12:00 PM</option>
                                            <option>1:00 PM</option>
                                            <option>2:00 PM</option>
                                            <option>3:00 PM</option>
                                            <option>4:00 PM</option>
                                            <option>5:00 PM</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Stylist Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Choose Stylist</span>
                                    </label>
                                    <select class="form-select w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                        <option>Any Available Stylist</option>
                                        <option>Sarah Johnson</option>
                                        <option>Michael Chen</option>
                                        <option>Emma Davis</option>
                                        <option>James Wilson</option>
                                    </select>
                                </div>

                                <!-- Real-time Availability Indicator -->
                                <div class="bg-green-50 rounded-xl p-4 flex items-center space-x-3 border border-green-100">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-green-800">Available for selected time slot!</p>
                                        <p class="text-xs text-green-600">Book now to secure your appointment</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Book Now Button -->
                            <button class="w-full py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                <span>Book Appointment</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
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

      

        <!-- Promotional Offers Section -->
        @include('components.promotional-offers-section')

        <!-- Testimonials Section -->
        @include('components.testimonials-section')

        <!-- Contact Section -->
        @include('components.contact-section')

          <!-- Specialists Section -->
        @include('components.specialists-section')

        <!-- FAQ Section -->
        @include('components.faq-section')

        <!-- Gallery Section -->
@include('components.gallery-section')

<!-- Blog Section -->
@include('components.blog-section')

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
