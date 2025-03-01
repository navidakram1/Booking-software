@props(['showNewsletter' => true])

<footer class="relative bg-gradient-to-b from-white/5 via-white/10 to-white/20 backdrop-blur-xl border-t border-white/10">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-20 w-96 h-96 bg-pink-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Newsletter Section with Animation -->
        @if($showNewsletter)
        <div class="mb-16 transform hover:scale-[1.01] transition-all duration-300">
            <div class="max-w-xl mx-auto text-center">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-4">
                    Join Our Beauty Community
                </h3>
                <p class="text-gray-600 mb-8">Get exclusive offers, beauty tips, and updates delivered to your inbox.</p>
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Enter your email" 
                           class="flex-1 px-6 py-3 rounded-xl border border-gray-200 bg-white/50 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 placeholder-gray-400">
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:shadow-lg hover:shadow-purple-500/20 transform hover:translate-y-[-2px] transition-all duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Company Info -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center transform group-hover:rotate-6 transition-transform duration-300">
                        <span class="text-white text-lg font-bold">G</span>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</span>
                </div>
                <p class="text-gray-600">Elevating beauty through expert care and personalized service.</p>
                <div class="flex space-x-5">
                    <a href="https://facebook.com/glamgo" target="_blank" class="text-gray-400 hover:text-pink-500 transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="https://instagram.com/glamgo" target="_blank" class="text-gray-400 hover:text-pink-500 transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                    </a>
                    <a href="https://twitter.com/glamgo" target="_blank" class="text-gray-400 hover:text-pink-500 transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                    </a>
                    <a href="https://pinterest.com/glamgo" target="_blank" class="text-gray-400 hover:text-pink-500 transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="https://youtube.com/glamgo" target="_blank" class="text-gray-400 hover:text-pink-500 transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Main Pages -->
            <div>
                <h4 class="text-lg font-semibold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-6">Main Pages</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Home</span>
                    </a></li>
                    <li><a href="{{ url('/services') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Services</span>
                    </a></li>
                    <li><a href="{{ url('/specialists') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Specialists</span>
                    </a></li>
                    <li><a href="{{ url('/gallery') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Gallery</span>
                    </a></li>
                    <li><a href="{{ url('/about') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>About</span>
                    </a></li>
                    <li><a href="{{ url('/contact') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Contact</span>
                    </a></li>
                    <li><a href="{{ url('/booking') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Book Now</span>
                    </a></li>
                </ul>
            </div>

            <!-- Services & Features -->
            <div>
                <h4 class="text-lg font-semibold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-6">Services & Features</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/services/hair') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Hair Services</span>
                    </a></li>
                    <li><a href="{{ url('/services/makeup') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Makeup Services</span>
                    </a></li>
                    <li><a href="{{ url('/services/nails') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Nail Services</span>
                    </a></li>
                    <li><a href="{{ url('/services/spa') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Spa Services</span>
                    </a></li>
                    <li><a href="{{ url('/services/beauty') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Beauty Treatments</span>
                    </a></li>
                    <li><a href="{{ url('/services/packages') }}" class="text-gray-600 hover:text-pink-500 transition-colors flex items-center space-x-2 group">
                        <span class="w-1 h-1 rounded-full bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span>Special Packages</span>
                    </a></li>
                </ul>
            </div>

            <!-- Contact & Support -->
            <div>
                <h4 class="text-lg font-semibold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-6">Contact & Support</h4>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center group-hover:bg-pink-500/20 transition-colors">
                            <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-gray-600">123 Beauty Street, Fashion District, City, State 12345</span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center group-hover:bg-pink-500/20 transition-colors">
                            <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-gray-600">info@glamgo.com</span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center group-hover:bg-pink-500/20 transition-colors">
                            <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <span class="text-gray-600">(555) 123-4567</span>
                    </li>
                    <li class="mt-4">
                        <p class="text-gray-600 font-semibold">Business Hours:</p>
                        <p class="text-gray-600">Mon - Fri: 9:00 AM - 8:00 PM</p>
                        <p class="text-gray-600">Saturday: 9:00 AM - 6:00 PM</p>
                        <p class="text-gray-600">Sunday: 10:00 AM - 4:00 PM</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-16 pt-8 border-t border-gray-200/20">
            <div class="text-center space-y-4">
                <p class="text-gray-600">&copy; {{ date('Y') }} GlamGo. All rights reserved.</p>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="{{ url('/privacy') }}" class="text-gray-500 hover:text-pink-500 transition-colors">Privacy Policy</a>
                    <a href="{{ url('/terms') }}" class="text-gray-500 hover:text-pink-500 transition-colors">Terms of Service</a>
                    <a href="{{ url('/cancellation') }}" class="text-gray-500 hover:text-pink-500 transition-colors">Cancellation Policy</a>
                    <a href="{{ url('/refund') }}" class="text-gray-500 hover:text-pink-500 transition-colors">Refund Policy</a>
                    <a href="{{ url('/faq') }}" class="text-gray-500 hover:text-pink-500 transition-colors">FAQ</a>
                    <a href="{{ url('/help') }}" class="text-gray-500 hover:text-pink-500 transition-colors">Help Center</a>
                </div>
            </div>
        </div>
    </div>
</footer> 