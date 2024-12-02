<!-- Booking Section -->
<section id="booking" class="py-24 relative overflow-hidden" x-data="{
    currentStep: 1,
    serviceType: 'in_store',
    selectedCategory: '',
    selectedService: null,
    selectedSpecialist: null,
    categories: ['Salon', 'Massage', 'Skincare', 'Nail Care'],
    services: {
        'Salon': ['Haircut', 'Hair Coloring', 'Hair Styling', 'Hair Treatment'],
        'Massage': ['Swedish Massage', 'Deep Tissue', 'Hot Stone', 'Aromatherapy'],
        'Skincare': ['Facial', 'Body Scrub', 'Anti-aging Treatment', 'Skin Brightening'],
        'Nail Care': ['Manicure', 'Pedicure', 'Nail Art', 'Gel Extensions']
    },
    date: '',
    time: '',
    form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        notes: '',
        payment_method: 'pay_later',
        coupon: ''
    }
}">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-intersect="$el.classList.add('animate-fade-in')">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Book Your Service</span>
            </h2>
            <p class="text-gray-600 text-lg">Experience luxury and professional care with our easy booking process.</p>
        </div>

        <!-- Progress Steps -->
        <div class="flex justify-center items-center space-x-4 mb-12">
            <template x-for="step in 3" :key="step">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"
                         :class="currentStep >= step ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white' : 'bg-gray-200 text-gray-500'">
                        <span x-text="step"></span>
                    </div>
                    <div x-show="step < 3" class="w-16 h-1 mx-2"
                         :class="currentStep > step ? 'bg-gradient-to-r from-pink-500 to-purple-600' : 'bg-gray-200'"></div>
                </div>
            </template>
        </div>

        <!-- Booking Form Container -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8">
                <!-- Step 1: Service Selection -->
                <div x-show="currentStep === 1" class="space-y-8">
                    <!-- Service Type Toggle -->
                    <div class="flex justify-center mb-8">
                        <div class="bg-gray-100 p-2 rounded-xl inline-flex">
                            <button @click="serviceType = 'in_store'" 
                                    class="px-6 py-3 rounded-lg text-sm font-medium transition-all duration-300"
                                    :class="serviceType === 'in_store' ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-gray-900'">
                                In-Store Service
                            </button>
                            <button @click="serviceType = 'home'" 
                                    class="px-6 py-3 rounded-lg text-sm font-medium transition-all duration-300"
                                    :class="serviceType === 'home' ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-gray-900'">
                                Home Service
                            </button>
                        </div>
                    </div>

                    <!-- Service Category -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <template x-for="category in categories" :key="category">
                            <button @click="selectedCategory = category" 
                                    class="p-4 rounded-xl border-2 transition-all duration-300 flex flex-col items-center space-y-2"
                                    :class="selectedCategory === category ? 'border-pink-500 bg-pink-50' : 'border-gray-200 hover:border-pink-300'">
                                <span class="text-lg font-medium" x-text="category"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Service Selection -->
                    <div x-show="selectedCategory" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template x-for="service in services[selectedCategory]" :key="service">
                            <button @click="selectedService = service" 
                                    class="p-4 rounded-xl border-2 transition-all duration-300 text-left"
                                    :class="selectedService === service ? 'border-pink-500 bg-pink-50' : 'border-gray-200 hover:border-pink-300'">
                                <span class="font-medium" x-text="service"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Next Button -->
                    <div class="flex justify-end mt-8">
                        <button @click="currentStep = 2" 
                                :disabled="!selectedService"
                                class="px-8 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300">
                            Next Step
                        </button>
                    </div>
                </div>

                <!-- Step 2: Date and Time -->
                <div x-show="currentStep === 2" class="space-y-8">
                    <!-- Date Selection -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Select Date</label>
                        <input type="date" x-model="date" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                    </div>

                    <!-- Time Selection -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Select Time</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <template x-for="hour in ['09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00']">
                                <button @click="time = hour"
                                        class="px-4 py-3 rounded-xl border-2 transition-all duration-300"
                                        :class="time === hour ? 'border-pink-500 bg-pink-50' : 'border-gray-200 hover:border-pink-300'"
                                        x-text="hour">
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Address (for home service) -->
                    <div x-show="serviceType === 'home'" class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Your Address</label>
                        <textarea x-model="form.address" 
                                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                  rows="3"
                                  placeholder="Please provide your complete address with landmarks"></textarea>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button @click="currentStep = 1" 
                                class="px-8 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300">
                            Previous
                        </button>
                        <button @click="currentStep = 3" 
                                :disabled="!date || !time"
                                class="px-8 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300">
                            Next Step
                        </button>
                    </div>
                </div>

                <!-- Step 3: Personal Details -->
                <div x-show="currentStep === 3" class="space-y-8">
                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" x-model="form.name" 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="Enter your full name">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" x-model="form.email" 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="Enter your email">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" x-model="form.phone" 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="Enter your phone number">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Special Requests (Optional)</label>
                            <textarea x-model="form.notes" 
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                      rows="3"
                                      placeholder="Any special requests or notes"></textarea>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <div class="flex space-x-4">
                            <button @click="form.payment_method = 'pay_now'" 
                                    class="flex-1 px-4 py-3 rounded-xl border-2 transition-all duration-300"
                                    :class="form.payment_method === 'pay_now' ? 'border-pink-500 bg-pink-50' : 'border-gray-200 hover:border-pink-300'">
                                Pay Now
                            </button>
                            <button @click="form.payment_method = 'pay_later'" 
                                    class="flex-1 px-4 py-3 rounded-xl border-2 transition-all duration-300"
                                    :class="form.payment_method === 'pay_later' ? 'border-pink-500 bg-pink-50' : 'border-gray-200 hover:border-pink-300'">
                                Pay at Venue
                            </button>
                        </div>
                    </div>

                    <!-- Coupon Code -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Coupon Code (Optional)</label>
                        <input type="text" x-model="form.coupon" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                               placeholder="Enter coupon code if you have one">
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button @click="currentStep = 2" 
                                class="px-8 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300">
                            Previous
                        </button>
                        <button @click="$dispatch('submit-booking')" 
                                :disabled="!form.name || !form.email || !form.phone"
                                class="px-8 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300">
                            Confirm Booking
                        </button>
                    </div>
                </div>
            </div>
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
