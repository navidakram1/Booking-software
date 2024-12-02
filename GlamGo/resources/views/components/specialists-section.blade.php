<!-- Specialists Section -->
<section id="specialists" class="py-24 relative overflow-hidden" x-data="{ 
    specialists: [
        { 
            id: 1, 
            name: 'Sarah Johnson',
            role: 'Hair Stylist',
            specialty: 'Color Specialist',
            image: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330',
            availability: ['Mon', 'Wed', 'Fri'],
            rating: 4.9,
            reviews: 127
        },
        { 
            id: 2, 
            name: 'Emily Davis',
            role: 'Makeup Artist',
            specialty: 'Bridal Makeup',
            image: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80',
            availability: ['Tue', 'Thu', 'Sat'],
            rating: 4.8,
            reviews: 98
        },
        { 
            id: 3, 
            name: 'Michael Chen',
            role: 'Massage Therapist',
            specialty: 'Deep Tissue',
            image: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e',
            availability: ['Wed', 'Thu', 'Sat'],
            rating: 4.9,
            reviews: 156
        },
        { 
            id: 4, 
            name: 'Lisa Anderson',
            role: 'Nail Artist',
            specialty: '3D Nail Art',
            image: 'https://images.unsplash.com/photo-1607746882042-944635dfe10e',
            availability: ['Mon', 'Tue', 'Fri'],
            rating: 4.7,
            reviews: 89
        }
    ]
}">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-intersect="$el.classList.add('animate-fade-in')">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Meet Our Specialists</span>
            </h2>
            <p class="text-gray-600 text-lg">Experience the expertise of our talented beauty professionals dedicated to making you look and feel your best.</p>
        </div>

        <!-- Specialists Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <template x-for="specialist in specialists" :key="specialist.id">
                <div class="group">
                    <div class="relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <!-- Specialist Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img :src="specialist.image" 
                                 :alt="specialist.name"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0"></div>
                        </div>

                        <!-- Specialist Info -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900" x-text="specialist.name"></h3>
                                    <p class="text-pink-500 font-medium" x-text="specialist.role"></p>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="text-yellow-400">★</span>
                                    <span class="font-medium" x-text="specialist.rating"></span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm text-gray-500" x-text="`${specialist.reviews} reviews`"></span>
                                <span class="text-sm font-medium text-purple-600" x-text="specialist.specialty"></span>
                            </div>

                            <!-- Availability Tags -->
                            <div class="flex flex-wrap gap-2">
                                <template x-for="day in specialist.availability" :key="day">
                                    <span class="px-3 py-1 text-xs font-medium bg-pink-50 text-pink-600 rounded-full" x-text="day"></span>
                                </template>
                            </div>

                            <!-- Book Button -->
                            <button @click="$dispatch('open-booking-modal', { specialist: specialist })" 
                                    class="w-full mt-4 px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                Book Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<style>
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
