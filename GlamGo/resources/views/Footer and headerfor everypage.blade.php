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
                    <a href="{{ route('home') }}" class="flex items-center space-x-1.5 sm:space-x-2">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs sm:text-sm font-bold">G</span>
                        </div>
                        <span class="text-base sm:text-lg font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</span>
                    </a>
                </div>

                <!-- Navigation Links - Hidden on Mobile -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('services') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmlleaaf.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Services</span>
                    </a>
                    <a href="{{ route('specialists') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/ktsahwvc.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Specialists</span>
                    </a>
                    <a href="{{ route('about') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>About</span>
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/diihvcfp.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Contact</span>
                    </a>
                </div>

                <!-- Right Side Navigation -->
                <div class="flex items-center space-x-1.5 sm:space-x-2">
                    <!-- Book Now Button -->
                    <button class="hidden md:flex px-3 lg:px-4 py-1.5 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs lg:text-sm rounded-full shadow-md hover:shadow-lg transition-all duration-300 items-center justify-center">
                        <a href="{{ route('booking') }}">Book Now</a>
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
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('services') }}" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/wmlleaaf.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Services</span>
                    </a>
                    <a href="{{ route('specialists') }}" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/ktsahwvc.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Specialists</span>
                    </a>
                    <a href="{{ route('about') }}" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>About</span>
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/diihvcfp.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Contact</span>
                    </a>
                    <a href="{{ route('booking') }}" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon src="https://cdn.lordicon.com/diihvcfp.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                        <span>Book Now</span>
                    </a>
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
    <!-- Footer Section -->
    <footer class="bg-gray-900/90 backdrop-blur-md text-white mt-20">
        <!-- Main Footer -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">G</span>
                        </div>
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</h3>
                    </div>
                    <p class="text-gray-400">Transform your style with our expert beauty services. Professional care for hair, nails, and skin.</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('social.facebook') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5L14.17.5C10.24.5,9.1,3.3,9.1,5.47V7.46H5.5v3.4h3.6V21.5h5.4V10.86h3.47l.5-3.4Z"/>
                            </svg>
                        </a>
                        <a href="{{ route('social.instagram') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.66,4.77-4.92,4.92-1.27.06-1.64.07-4.85.07s-3.58,0-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.64-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.9,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.27.2-6.78,2.71-7,7C0,8.33,0,8.74,0,12s0,3.67.07,4.95c.2,4.27,2.71,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.27-.2,6.78-2.71,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.27-2.71-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z"/>
                            </svg>
                        </a>
                        <a href="{{ route('social.twitter') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.95,4.57a10,10,0,0,1-2.82.77,4.96,4.96,0,0,0,2.16-2.72,9.9,9.9,0,0,1-3.12,1.19A4.92,4.92,0,0,0,11.8,7.3,14,14,0,0,1,1.64,2.73a4.92,4.92,0,0,0,1.52,6.57A4.86,4.86,0,0,1,.92,8.67v.06a4.93,4.93,0,0,0,3.95,4.83,4.86,4.86,0,0,1-2.22.08,4.93,4.93,0,0,0,4.6,3.42A9.87,9.87,0,0,1,0,19.14,13.93,13.93,0,0,0,7.55,21a13.9,13.9,0,0,0,14-13.73c0-.21,0-.42,0-.63A10,10,0,0,0,24,4.59Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Services</a></li>
                    <li><a href="{{ route('specialists') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Our Team</a></li>
                    <li><a href="{{ route('booking') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Book Now</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Gallery</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Our Services</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('haircut') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Haircut & Styling</a></li>
                    <li><a href="{{ route('coloring') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Hair Coloring</a></li>
                    <li><a href="{{ route('facial') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Facial Treatments</a></li>
                    <li><a href="{{ route('massage') }}" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Massage Therapy</a></li>
                </ul>
            </div>

            <!-- Payment Methods -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Payment Methods</h4>
                <div class="space-y-4">
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-gray-800/50 p-2 rounded-md backdrop-blur-sm">
                            <svg class="w-8 h-8 text-[#1434CB]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                            </svg>
                        </span>
                        <span class="bg-gray-800/50 p-2 rounded-md backdrop-blur-sm">
                            <svg class="w-8 h-8 text-[#ff6b6b]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                            </svg>
                        </span>
                        <span class="bg-gray-800/50 p-2 rounded-md backdrop-blur-sm">
                            <svg class="w-8 h-8 text-[#2790C3]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16.015 14.378c0-.32-.135-.496-.344-.622-.21-.127-.509-.189-.898-.189h-1.727v1.675h1.727c.389 0 .688-.063.898-.19.209-.126.344-.307.344-.674zm-5.436-1.847h-1.974v1.516h1.974c.718 0 1.173-.252 1.173-.764-.001-.51-.455-.752-1.173-.752z"/>
                                <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm5.051 14.406h-1.84l-1.088-1.704h-2.522v1.704h-1.586v-6.812h3.796c.814 0 1.471.186 1.97.557.499.371.748.909.748 1.613 0 .979-.574 1.641-1.539 1.916l1.061 1.726zm-7.251-.283a2.97 2.97 0 0 1-1.133.227H5.469v-6.812h3.198c.392 0 .771.06 1.133.179a2.346 2.346 0 0 1 .943.538c.223.231.397.51.523.837.126.327.189.697.189 1.111 0 .42-.063.794-.189 1.121-.126.327-.3.604-.523.832-.223.229-.545.404-.943.527z"/>
                            </svg>
                        </span>
                        <span class="bg-gray-800/50 p-2 rounded-md backdrop-blur-sm">
                            <svg class="w-8 h-8 text-[#3C8A40]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                            </svg>
                        </span>
                    </div>
                    <p class="text-gray-400 text-sm">Secure payments processed by Stripe</p>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-sm">SSL Secured Checkout</span>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                <ul class="space-y-2">
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>123 Beauty Street, CA 90210</span>
                    </li>
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>info@glamgo.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm"> 2024 GlamGo. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-pink-500 text-sm transition-colors duration-300">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-gray-400 hover:text-pink-500 text-sm transition-colors duration-300">Terms of Service</a>
                    <a href="{{ route('cookies') }}" class="text-gray-400 hover:text-pink-500 text-sm transition-colors duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>