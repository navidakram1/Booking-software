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
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.897 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.897-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#services" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Services</a></li>
                    <li><a href="#specialists" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Our Team</a></li>
                    <li><a href="#booking" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Book Now</a></li>
                    <li><a href="#gallery" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Gallery</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Our Services</h4>
                <ul class="space-y-2">
                    <li><a href="#haircut" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Haircut & Styling</a></li>
                    <li><a href="#coloring" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Hair Coloring</a></li>
                    <li><a href="#facial" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Facial Treatments</a></li>
                    <li><a href="#massage" class="text-gray-400 hover:text-pink-500 transition-colors duration-300">Massage Therapy</a></li>
                </ul>
            </div>

            <!-- Payment Methods -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Payment Methods</h4>
                <div class="space-y-4">
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-gray-800/50 p-2 rounded-md backdrop-blur-sm">
                            <svg class="w-8 h-8 text-[#1434CB]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.343 18.031c.058.049.12.098.181.146-1.177.783-2.59 1.238-4.107 1.238C3.32 19.416 0 16.096 0 12c0-4.095 3.32-7.416 7.416-7.416 1.518 0 2.931.456 4.105 1.238-.06.051-.12.098-.181.146C9.457 7.46 8.24 9.572 8.24 12c0 2.427 1.217 4.539 3.103 5.031zm13.074-1.02c-1.158.674-2.979 1.125-5.098 1.125h-.686c-2.604 0-4.562-.493-5.781-1.27C11.083 15.984 9.882 13.819 9.882 12c0-1.82 1.2-3.984 2.97-4.866 1.219-.776 3.177-1.27 5.781-1.27h.686c2.119 0 3.94.451 5.098 1.125C25.354 7.871 24 9.967 24 12c0 2.033-1.354 4.129-2.583 5.011z"/>
                            </svg>
                        </span>
                        <span class="bg-gray-800/50 p-2 rounded-md backdrop-blur-sm">
                            <svg class="w-8 h-8 text-[#ff6b6b]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.343 18.031c.058.049.12.098.181.146-1.177.783-2.59 1.238-4.107 1.238C3.32 19.416 0 16.096 0 12c0-4.095 3.32-7.416 7.416-7.416 1.518 0 2.931.456 4.105 1.238-.06.051-.12.098-.181.146C9.457 7.46 8.24 9.572 8.24 12c0 2.427 1.217 4.539 3.103 5.031zm13.074-1.02c-1.158.674-2.979 1.125-5.098 1.125h-.686c-2.604 0-4.562-.493-5.781-1.27C11.083 15.984 9.882 13.819 9.882 12c0-1.82 1.2-3.984 2.97-4.866 1.219-.776 3.177-1.27 5.781-1.27h.686c2.119 0 3.94.451 5.098 1.125C25.354 7.871 24 9.967 24 12c0 2.033-1.354 4.129-2.583 5.011z"/>
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
                    <a href="#privacy" class="text-gray-400 hover:text-pink-500 text-sm transition-colors duration-300">Privacy Policy</a>
                    <a href="#terms" class="text-gray-400 hover:text-pink-500 text-sm transition-colors duration-300">Terms of Service</a>
                    <a href="#cookies" class="text-gray-400 hover:text-pink-500 text-sm transition-colors duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>