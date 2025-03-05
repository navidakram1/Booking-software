@props(['show_newsletter' => true])

<footer class="bg-white/10 backdrop-blur-md mt-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">G</span>
                    </div>
                    <span class="text-lg font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</span>
                </div>
                <p class="text-gray-600">Your one-stop destination for all beauty and wellness services.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/about') }}" class="text-gray-600 hover:text-pink-500 transition-colors">About Us</a></li>
                    <li><a href="{{ url('/services') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Services</a></li>
                    <li><a href="{{ url('/specialists') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Specialists</a></li>
                    <li><a href="{{ url('/gallery') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Gallery</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Services</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Hair Styling</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Makeup</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Nail Care</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Spa Treatment</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Skin Care</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Us</h3>
                <ul class="space-y-2">
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-map-marker-alt text-pink-500"></i>
                        <span class="text-gray-600">123 Beauty Street, City</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-phone text-pink-500"></i>
                        <span class="text-gray-600">(555) 123-4567</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-envelope text-pink-500"></i>
                        <span class="text-gray-600">info@glamgo.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-gray-200">
            <p class="text-center text-gray-500">&copy; {{ date('Y') }} GlamGo. All rights reserved.</p>
        </div>
    </div>
</footer> 