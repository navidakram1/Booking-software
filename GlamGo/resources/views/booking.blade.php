<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    @include('partials.header')

    <main class="pt-32 pb-20 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Booking Form -->
            <div class="booking-form rounded-3xl p-8 md:p-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">Book Your Appointment</h1>
                
                <form x-data="{ step: 1 }" class="space-y-8">
                    <!-- Step 1: Service Selection -->
                    <div x-show="step === 1" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-700">Choose Your Service</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-pink-500 transition-all duration-300">
                                <input type="radio" name="service" class="absolute inset-0 opacity-0" value="haircut">
                                <div class="flex items-center space-x-4">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/dqxvvqzi.json"
                                        trigger="hover"
                                        colors="primary:#ec4899,secondary:#9333ea"
                                        style="width:48px;height:48px">
                                    </lord-icon>
                                    <div>
                                        <h3 class="font-medium text-gray-900">Haircut & Styling</h3>
                                        <p class="text-sm text-gray-500">45-60 minutes</p>
                                    </div>
                                </div>
                            </label>
                            <!-- Add more service options -->
                        </div>
                        <button type="button" @click="step = 2" class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                            Continue
                        </button>
                    </div>

                    <!-- Step 2: Specialist Selection -->
                    <div x-show="step === 2" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-700">Choose Your Specialist</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-pink-500 transition-all duration-300">
                                <input type="radio" name="specialist" class="absolute inset-0 opacity-0" value="sarah">
                                <div class="flex items-center space-x-4">
                                    <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Sarah" class="w-12 h-12 rounded-full">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Sarah Johnson</h3>
                                        <p class="text-sm text-gray-500">Senior Stylist</p>
                                    </div>
                                </div>
                            </label>
                            <!-- Add more specialist options -->
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" @click="step = 1" class="w-full py-3 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 transition-all duration-300">
                                Back
                            </button>
                            <button type="button" @click="step = 3" class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                                Continue
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Date & Time Selection -->
                    <div x-show="step === 3" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-700">Choose Date & Time</h2>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-gray-700">Select Date</label>
                                <input type="date" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            </div>
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-gray-700">Select Time</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <button type="button" class="p-2 text-sm border border-gray-200 rounded-lg hover:border-pink-500 focus:border-pink-500 focus:ring-2 focus:ring-pink-500">
                                        9:00 AM
                                    </button>
                                    <!-- Add more time slots -->
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" @click="step = 2" class="w-full py-3 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 transition-all duration-300">
                                Back
                            </button>
                            <button type="button" @click="step = 4" class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                                Continue
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Contact Information -->
                    <div x-show="step === 4" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-700">Your Information</h2>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="tel" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Special Requests</label>
                                <textarea class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" @click="step = 3" class="w-full py-3 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 transition-all duration-300">
                                Back
                            </button>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                                Book Appointment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .booking-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        input[type="radio"]:checked + div {
            @apply ring-2 ring-pink-500;
        }
    </style>
</body>
</html>
