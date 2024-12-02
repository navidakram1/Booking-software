<!-- Services Section -->
<section id="services" class="py-24 relative overflow-hidden" x-data="{ 
    activeCategory: 'all',
    services: [
        { id: 1, category: 'hair', name: 'Hair Styling', description: 'Professional hair styling services including cuts, coloring, and treatments.', price: 49, image: 'https://images.unsplash.com/photo-1560066984-138dadb4c035', tag: 'Popular', tagClass: 'bg-pink-500' },
        { id: 2, category: 'massage', name: 'Massage Therapy', description: 'Relaxing massage treatments to rejuvenate your body and mind.', price: 79, image: 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881', tag: 'New', tagClass: 'bg-purple-500' },
        { id: 3, category: 'skin', name: 'Facial Treatment', description: 'Luxurious facial treatments for radiant and healthy skin.', price: 89, image: 'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2', tag: 'Premium', tagClass: 'bg-gradient-to-r from-pink-500 to-purple-600' },
        { id: 4, category: 'nail', name: 'Nail Art', description: 'Creative nail art and professional manicure services.', price: 39, image: 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b', tag: 'Trending', tagClass: 'bg-pink-500' },
        { id: 5, category: 'hair', name: 'Hair Treatment', description: 'Revitalizing hair treatments for healthy, shiny hair.', price: 69, image: 'https://images.unsplash.com/photo-1582095133179-bfd08e2fc6b3', tag: 'Recommended', tagClass: 'bg-purple-500' },
        { id: 6, category: 'skin', name: 'Body Spa', description: 'Luxurious body spa treatments for complete relaxation.', price: 99, image: 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874', tag: 'Luxury', tagClass: 'bg-gradient-to-r from-pink-500 to-purple-600' }
    ],
    isVisible(category) {
        return this.activeCategory === 'all' || category === this.activeCategory;
    }
}">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-intersect="$el.classList.add('animate-fade-in')">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Our Services</span>
            </h2>
            <p class="text-gray-600 text-lg">Discover our range of professional beauty and wellness services designed to enhance your natural beauty.</p>
        </div>

        <!-- Service Categories -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <template x-for="category in ['all', 'hair', 'skin', 'massage', 'nail']" :key="category">
                <button 
                    @click="activeCategory = category"
                    :class="{ 'active': activeCategory === category }"
                    class="category-btn px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 capitalize"
                    x-text="category === 'all' ? 'All Services' : category + ' Care'">
                </button>
            </template>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <template x-for="service in services" :key="service.id">
                <div class="service-card group" 
                     x-show="isVisible(service.category)"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-4">
                    <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="relative h-64">
                            <img :src="service.image" 
                                 :alt="service.name" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0"></div>
                            <div class="absolute bottom-4 left-4 right-4" x-show="service.tag">
                                <span :class="service.tagClass" class="px-4 py-1.5 text-white text-xs font-medium rounded-full" x-text="service.tag"></span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="service.name"></h3>
                            <p class="text-gray-600 mb-4" x-text="service.description"></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1">
                                    <span class="text-sm text-gray-500">From</span>
                                    <span class="text-2xl font-bold text-pink-500" x-text="'$' + service.price"></span>
                                </div>
                                <button @click="$dispatch('open-booking-modal', { service: service })" 
                                        class="book-btn px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- View All Services Button -->
        <div class="text-center mt-12">
            <button @click="activeCategory = 'all'" 
                    class="inline-flex items-center px-8 py-3 bg-white text-gray-800 font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 border border-gray-100">
                View All Services
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </button>
        </div>
    </div>
</section>

<style>
    .category-btn {
        background: white;
        color: #6B7280;
        border: 1px solid #E5E7EB;
    }

    .category-btn:hover, .category-btn.active {
        background: linear-gradient(to right, #EC4899, #9333EA);
        color: white;
        border-color: transparent;
    }

    .book-btn {
        background: #F3F4F6;
        color: #374151;
    }

    .book-btn:hover {
        background: linear-gradient(to right, #EC4899, #9333EA);
        color: white;
    }

    .service-card:hover .book-btn {
        background: linear-gradient(to right, #EC4899, #9333EA);
        color: white;
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
</style>
