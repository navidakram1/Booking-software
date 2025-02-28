@props(['isFixed' => true])

<header class="{{ $isFixed ? 'fixed' : '' }} w-full top-0 z-50">
    <nav class="nav-blur mx-auto max-w-5xl mt-3 sm:mt-4 md:mt-6 px-4 sm:px-6 py-2 rounded-full transition-all duration-300">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center space-x-1.5 sm:space-x-2">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs sm:text-sm font-bold">G</span>
                    </div>
                    <span class="text-base sm:text-lg font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</span>
                </a>
            </div>

            <!-- Navigation Links - Hidden on Mobile -->
            <div class="hidden md:flex items-center space-x-3">
                <x-nav-link href="{{ url('/') }}" icon="https://cdn.lordicon.com/wmwqvixz.json">Home</x-nav-link>
                <x-nav-link href="{{ url('/services') }}" icon="https://cdn.lordicon.com/zvllgyec.json">Services</x-nav-link>
                <x-nav-link href="{{ url('/gallery') }}" icon="https://cdn.lordicon.com/vixtkkbk.json">Gallery</x-nav-link>
                <x-nav-link href="{{ url('/contact') }}" icon="https://cdn.lordicon.com/hpivxauj.json">Contact</x-nav-link>
            </div>

            <!-- Right Side Navigation -->
            <div class="flex items-center space-x-1.5 sm:space-x-2">
                <!-- Book Now Button -->
                <a href="{{ route('booking.index') }}" class="hidden md:flex px-3 lg:px-4 py-1.5 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs lg:text-sm rounded-full shadow-md hover:shadow-lg transition-all duration-300 items-center justify-center space-x-2">
                    <span>Book Now</span>
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#ffffff,secondary:#ffffff" style="width:24px;height:24px"></lord-icon>
                </a>

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
            <div class="flex flex-col space-y-2 bg-white/90 backdrop-blur-sm rounded-2xl p-4 border border-gray-100 shadow-lg">
                <x-nav-link-mobile href="{{ url('/') }}" icon="https://cdn.lordicon.com/wmwqvixz.json">Home</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ url('/services') }}" icon="https://cdn.lordicon.com/zvllgyec.json">Services</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ url('/gallery') }}" icon="https://cdn.lordicon.com/vixtkkbk.json">Gallery</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ url('/contact') }}" icon="https://cdn.lordicon.com/hpivxauj.json">Contact</x-nav-link-mobile>
                
                <!-- Mobile Book Now Button -->
                <a href="{{ route('booking.index') }}" class="flex items-center justify-center px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 space-x-2 mt-2">
                    <span class="font-medium">Book Now</span>
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#ffffff,secondary:#ffffff" style="width:20px;height:20px"></lord-icon>
                </a>
            </div>
        </div>
    </nav>
</header>

@push('styles')
<style>
    .nav-blur {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Mobile menu animation */
    #mobile-menu.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

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