<!-- Footer -->
<footer class="bg-gray-900 text-white pt-16 pb-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">GlamGo</h3>
                <p class="text-gray-400 mb-4">Your premier destination for beauty and wellness services.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition-colors">Services</a></li>
                    <li><a href="{{ route('specialists') }}" class="text-gray-400 hover:text-white transition-colors">Specialists</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-gray-400 hover:text-white transition-colors">Gallery</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="text-xl font-bold mb-4">Our Services</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('services', ['category' => 'hair-care']) }}" class="text-gray-400 hover:text-white transition-colors">Hair Care</a></li>
                    <li><a href="{{ route('services', ['category' => 'nail-care']) }}" class="text-gray-400 hover:text-white transition-colors">Nail Care</a></li>
                    <li><a href="{{ route('services', ['category' => 'facial']) }}" class="text-gray-400 hover:text-white transition-colors">Facial</a></li>
                    <li><a href="{{ route('services', ['category' => 'massage']) }}" class="text-gray-400 hover:text-white transition-colors">Massage</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                <ul class="space-y-2">
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        123 Beauty Street, City, Country
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-phone mr-2"></i>
                        +1 234 567 890
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-envelope mr-2"></i>
                        info@glamgo.com
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© {{ date('Y') }} GlamGo. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                    <a href="{{ route('cookies') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer> 