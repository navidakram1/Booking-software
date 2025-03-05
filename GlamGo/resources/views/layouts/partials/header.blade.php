<!-- Header -->
<header class="bg-white shadow-sm fixed w-full top-0 z-50">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center">
                <span class="text-2xl font-bold text-primary">GlamGo</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('home') ? 'text-primary' : '' }}">Home</a>
                <a href="{{ route('services') }}" class="text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('services*') ? 'text-primary' : '' }}">Services</a>
                <a href="{{ route('specialists') }}" class="text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('specialists*') ? 'text-primary' : '' }}">Specialists</a>
                <a href="{{ route('gallery') }}" class="text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('gallery') ? 'text-primary' : '' }}">Gallery</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('about') ? 'text-primary' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('contact') ? 'text-primary' : '' }}">Contact</a>
            </div>

            <!-- Book Now Button -->
            <div class="hidden md:block">
                <a href="{{ route('booking.index') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                    Book Now
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-600 hover:text-primary" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="pt-4 pb-3 space-y-3">
                <a href="{{ route('home') }}" class="block text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('home') ? 'text-primary' : '' }}">Home</a>
                <a href="{{ route('services') }}" class="block text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('services*') ? 'text-primary' : '' }}">Services</a>
                <a href="{{ route('specialists') }}" class="block text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('specialists*') ? 'text-primary' : '' }}">Specialists</a>
                <a href="{{ route('gallery') }}" class="block text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('gallery') ? 'text-primary' : '' }}">Gallery</a>
                <a href="{{ route('about') }}" class="block text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('about') ? 'text-primary' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="block text-gray-600 hover:text-primary transition-colors {{ request()->routeIs('contact') ? 'text-primary' : '' }}">Contact</a>
                <a href="{{ route('booking.index') }}" class="block bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors text-center mt-4">Book Now</a>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Menu Toggle Script -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script> 