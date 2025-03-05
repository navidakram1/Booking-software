<section id="faq" class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Frequently Asked Questions</h2>
            <p class="text-gray-600">Find answers to common questions about our services</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="space-y-6" x-data="{ activeTab: null }">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button @click="activeTab = activeTab === 1 ? null : 1" 
                            class="flex items-center justify-between w-full p-6 text-left">
                        <span class="text-lg font-semibold">How do I book an appointment?</span>
                        <svg class="w-6 h-6 transform transition-transform duration-200" 
                             :class="{'rotate-180': activeTab === 1}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeTab === 1" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="p-6 pt-0 text-gray-600">
                        You can book an appointment through our online booking system, by calling us, or using our mobile app. 
                        Choose your preferred service, select a stylist, pick a date and time that works for you, and confirm your booking.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button @click="activeTab = activeTab === 2 ? null : 2" 
                            class="flex items-center justify-between w-full p-6 text-left">
                        <span class="text-lg font-semibold">What is your cancellation policy?</span>
                        <svg class="w-6 h-6 transform transition-transform duration-200" 
                             :class="{'rotate-180': activeTab === 2}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeTab === 2" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="p-6 pt-0 text-gray-600">
                        We require at least 24 hours notice for cancellations. Late cancellations or no-shows may result in a 
                        cancellation fee. Please contact us as soon as possible if you need to reschedule your appointment.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button @click="activeTab = activeTab === 3 ? null : 3" 
                            class="flex items-center justify-between w-full p-6 text-left">
                        <span class="text-lg font-semibold">Do you offer home services?</span>
                        <svg class="w-6 h-6 transform transition-transform duration-200" 
                             :class="{'rotate-180': activeTab === 3}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeTab === 3" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="p-6 pt-0 text-gray-600">
                        Yes, we offer home services for select treatments. Additional travel fees may apply depending on your location. 
                        Check our home service menu for available treatments and coverage areas.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button @click="activeTab = activeTab === 4 ? null : 4" 
                            class="flex items-center justify-between w-full p-6 text-left">
                        <span class="text-lg font-semibold">What payment methods do you accept?</span>
                        <svg class="w-6 h-6 transform transition-transform duration-200" 
                             :class="{'rotate-180': activeTab === 4}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeTab === 4" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="p-6 pt-0 text-gray-600">
                        We accept all major credit cards, debit cards, and digital payments including Apple Pay and Google Pay. 
                        Cash payments are also welcome at our salon.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button @click="activeTab = activeTab === 5 ? null : 5" 
                            class="flex items-center justify-between w-full p-6 text-left">
                        <span class="text-lg font-semibold">How does the loyalty program work?</span>
                        <svg class="w-6 h-6 transform transition-transform duration-200" 
                             :class="{'rotate-180': activeTab === 5}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeTab === 5" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="p-6 pt-0 text-gray-600">
                        Our loyalty program rewards you with points for every service and product purchase. Earn 1 point per dollar spent, 
                        and redeem points for services, products, or exclusive offers. Members also get special birthday rewards and early 
                        access to promotions.
                    </div>
                </div>
            </div>

            <!-- Still Have Questions -->
            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-4">Still have questions? We're here to help!</p>
                <a href="#contact" class="inline-flex items-center text-pink-500 hover:text-pink-600">
                    <span>Contact our support team</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
