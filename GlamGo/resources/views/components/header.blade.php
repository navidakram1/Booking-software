<header class="fixed w-full top-0 z-50">
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
                <a href="{{ url('/') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                    <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Home</span>
                </a>
                <a href="{{ url('/services') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                    <lord-icon src="https://cdn.lordicon.com/zvllgyec.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Services</span>
                </a>
                <a href="{{ url('/gallery') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                    <lord-icon src="https://cdn.lordicon.com/vixtkkbk.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Gallery</span>
                </a>
                <a href="{{ url('/contact') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                    <lord-icon src="https://cdn.lordicon.com/hpivxauj.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Contact</span>
                </a>
                <a href="{{ url('/dashboard') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                    <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:24px;height:24px"></lord-icon>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Book Now Button -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('/book/services') }}" class="py-2 px-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02]">
                    Book Now
                </a>
                <!-- Mobile Menu Button -->
                <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline">
                    <lord-icon
                        src="https://cdn.lordicon.com/wgwcqouc.json"
                        trigger="morph"
                        colors="primary:#ec4899,secondary:#9333ea"
                        style="width:32px;height:32px">
                    </lord-icon>
                </button>
            </div>
        </div>
    </nav>
</header>

<style>
    .nav-blur {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
</style>
