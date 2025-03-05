<section id="availability" class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Availability</h2>
            <p class="text-gray-600">Check our working hours and book your preferred time slot</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Working Hours -->
            <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl shadow-lg p-6">
                <h3 class="text-2xl font-bold mb-6">Working Hours</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Monday - Friday</span>
                        <span class="font-semibold">9:00 AM - 8:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Saturday</span>
                        <span class="font-semibold">10:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Sunday</span>
                        <span class="font-semibold">Closed</span>
                    </div>
                    <div class="pt-4 border-t">
                        <div class="flex items-center text-green-600">
                            <div class="w-2 h-2 bg-green-600 rounded-full mr-2"></div>
                            <span>Currently Open</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Time Slots -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Available Time Slots</h3>
                        <div class="flex space-x-2">
                            <button class="p-2 rounded-lg hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-2 mb-4">
                        <div class="text-center text-gray-500 text-sm">Sun</div>
                        <div class="text-center text-gray-500 text-sm">Mon</div>
                        <div class="text-center text-gray-500 text-sm">Tue</div>
                        <div class="text-center text-gray-500 text-sm">Wed</div>
                        <div class="text-center text-gray-500 text-sm">Thu</div>
                        <div class="text-center text-gray-500 text-sm">Fri</div>
                        <div class="text-center text-gray-500 text-sm">Sat</div>
                        
                        <!-- Calendar Days -->
                        <template x-for="day in 31">
                            <button class="aspect-square rounded-lg hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2"
                                    :class="{'bg-pink-100': day === 15}">
                                <span x-text="day" class="text-sm"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Time Slots Grid -->
                    <div class="border-t pt-6">
                        <h4 class="font-semibold mb-4">Available Slots for Today</h4>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            <button class="px-4 py-2 text-sm rounded-lg border hover:border-pink-500 hover:text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                9:00 AM
                            </button>
                            <button class="px-4 py-2 text-sm rounded-lg border hover:border-pink-500 hover:text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                10:30 AM
                            </button>
                            <button class="px-4 py-2 text-sm rounded-lg border hover:border-pink-500 hover:text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                1:00 PM
                            </button>
                            <button class="px-4 py-2 text-sm rounded-lg border hover:border-pink-500 hover:text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                2:30 PM
                            </button>
                            <button class="px-4 py-2 text-sm rounded-lg border hover:border-pink-500 hover:text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                4:00 PM
                            </button>
                            <button class="px-4 py-2 text-sm rounded-lg border hover:border-pink-500 hover:text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                5:30 PM
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
