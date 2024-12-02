<section id="live-queue" class="py-16 bg-gradient-to-b from-white to-pink-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Live Queue Status</h2>
            <p class="text-gray-600">Check real-time in-store waiting times and join the queue remotely</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Current Queue Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold">Current Queue</h3>
                    <span class="px-4 py-1 bg-green-100 text-green-800 rounded-full text-sm">Live</span>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold text-purple-600 mb-2">12</div>
                    <p class="text-gray-500">People in queue</p>
                </div>
                <div class="mt-6 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Estimated Wait Time:</span>
                        <span class="font-semibold">45 mins</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Next Available:</span>
                        <span class="font-semibold">2:30 PM</span>
                    </div>
                </div>
            </div>

            <!-- Join Queue Card -->
            <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-4">Join Queue Now</h3>
                <p class="mb-6">Reserve your spot and get notified when it's your turn</p>
                <form class="space-y-4">
                    <div>
                        <input type="text" placeholder="Your Name" class="w-full px-4 py-2 rounded-xl bg-white/10 border border-white/20 placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                    <div>
                        <input type="tel" placeholder="Phone Number" class="w-full px-4 py-2 rounded-xl bg-white/10 border border-white/20 placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                    <button type="submit" class="w-full py-2 bg-white text-purple-600 rounded-xl font-semibold hover:bg-white/90 transition-colors duration-300">
                        Join Queue
                    </button>
                </form>
            </div>

            <!-- Queue Stats Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-6">Today's Stats</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Average Wait Time</p>
                            <p class="text-2xl font-bold">35 mins</p>
                        </div>
                        <lord-icon
                            src="https://cdn.lordicon.com/qznlhdss.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:48px;height:48px">
                        </lord-icon>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Served Today</p>
                            <p class="text-2xl font-bold">45</p>
                        </div>
                        <lord-icon
                            src="https://cdn.lordicon.com/imamsnbq.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:48px;height:48px">
                        </lord-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
