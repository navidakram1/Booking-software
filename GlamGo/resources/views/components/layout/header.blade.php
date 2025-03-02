@props(['isFixed' => true])

<!-- Navigation Header -->
<header class="{{ $isFixed ? 'fixed' : 'relative' }} w-full top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <nav class="nav-blur mx-auto max-w-7xl mt-3 sm:mt-4 md:mt-6 px-4 sm:px-6 py-2 rounded-full transition-all duration-300">
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
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ url('/') }}" class="nav-link">
                    <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Home</span>
                </a>
                <a href="{{ url('/services') }}" class="nav-link">
                    <lord-icon src="https://cdn.lordicon.com/zvllgyec.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Services</span>
                </a>
                <a href="{{ url('/specialists') }}" class="nav-link">
                    <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Specialists</span>
                </a>
                <a href="{{ url('/gallery') }}" class="nav-link">
                    <lord-icon src="https://cdn.lordicon.com/vixtkkbk.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Gallery</span>
                </a>
                <a href="{{ url('/contact') }}" class="nav-link">
                    <lord-icon src="https://cdn.lordicon.com/hpivxauj.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Contact</span>
                </a>
            </div>

            <!-- Right Side Navigation -->
            <div class="flex items-center space-x-1.5 sm:space-x-2">
                <!-- Book Now Button -->
                <a href="{{ route('booking.index') }}" class="book-now-btn">
                    <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#ffffff" style="width:20px;height:20px"></lord-icon>
                    <span>Book Now</span>
                </a>

                <!-- Mobile Menu Button -->
                <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="mobileMenuOpen = !mobileMenuOpen">
                    <lord-icon src="https://cdn.lordicon.com/wgwcqouc.json" trigger="morph" colors="primary:#ec4899,secondary:#9333ea" style="width:32px;height:32px"></lord-icon>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak class="mobile-menu" :class="{'opacity-100 translate-y-0': mobileMenuOpen}">
            <div class="flex flex-col space-y-2 bg-white/90 backdrop-blur-sm rounded-2xl p-3 border border-gray-100 shadow-lg">
                <a href="{{ url('/') }}" class="mobile-nav-link">
                    <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Home</span>
                </a>
                <a href="{{ url('/services') }}" class="mobile-nav-link">
                    <lord-icon src="https://cdn.lordicon.com/zvllgyec.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Services</span>
                </a>
                <a href="{{ url('/specialists') }}" class="mobile-nav-link">
                    <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Specialists</span>
                </a>
                <a href="{{ url('/gallery') }}" class="mobile-nav-link">
                    <lord-icon src="https://cdn.lordicon.com/vixtkkbk.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Gallery</span>
                </a>
                <a href="{{ url('/contact') }}" class="mobile-nav-link">
                    <lord-icon src="https://cdn.lordicon.com/hpivxauj.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Contact</span>
                </a>
                <!-- Mobile Book Now Button -->
                <a href="{{ route('booking.index') }}" class="mobile-book-now-btn">
                    <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#ffffff" style="width:20px;height:20px"></lord-icon>
                    <span>Book Now</span>
                </a>
            </div>
        </div>
    </nav>
</header>

<style>
.nav-blur {
    background-color: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
}

.nav-link {
    @apply flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm font-medium hover:bg-pink-50/50 transition-all duration-300;
}

.mobile-nav-link {
    @apply flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300;
}

.book-now-btn {
    @apply flex items-center space-x-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:shadow-lg hover:shadow-pink-500/30 transition-all duration-300;
}

.mobile-book-now-btn {
    @apply flex items-center justify-center space-x-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-xl font-medium hover:shadow-lg hover:shadow-pink-500/30 transition-all duration-300;
}

.mobile-menu {
    @apply md:hidden mt-4 opacity-0 transition-all duration-300 transform -translate-y-2;
}

[x-cloak] {
    display: none !important;
}
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        let isOpen = false;

        mobileMenuButton.addEventListener('click', function() {
            isOpen = !isOpen;
            mobileMenu.classList.toggle('hidden');
            
            // Update button icon for open/close state
            const svg = this.querySelector('svg');
            if (isOpen) {
                svg.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />`;
            } else {
                svg.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />`;
            }

            // Animate menu
            setTimeout(() => {
                mobileMenu.classList.toggle('opacity-0');
                mobileMenu.classList.toggle('-translate-y-2');
            }, 20);
        });
    });
</script>
@endpush 