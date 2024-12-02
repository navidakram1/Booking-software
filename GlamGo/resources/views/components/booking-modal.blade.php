<!-- Booking Modal -->
<div x-data="{ 
    isOpen: false,
    service: null,
    loading: false,
    success: false,
    error: null,
    form: {
        service_id: '',
        service_name: '',
        price: '',
        name: '',
        email: '',
        phone: '',
        date: '',
        time: '',
        notes: ''
    },
    timeSlots: [
        '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
        '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM',
        '05:00 PM', '06:00 PM'
    ],
    async submitForm() {
        this.loading = true;
        this.error = null;
        
        try {
            const response = await fetch('/api/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    ...this.form,
                    service_id: this.service.id,
                    service_name: this.service.name,
                    price: this.service.price
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Something went wrong');
            }

            this.success = true;
            this.form = {
                service_id: '',
                service_name: '',
                price: '',
                name: '',
                email: '',
                phone: '',
                date: '',
                time: '',
                notes: ''
            };

            // Close modal after 2 seconds
            setTimeout(() => {
                this.isOpen = false;
                this.success = false;
            }, 2000);

        } catch (err) {
            this.error = err.message;
        } finally {
            this.loading = false;
        }
    }
}" 
    @open-booking-modal.window="
        isOpen = true;
        service = $event.detail.service;
        error = null;
        success = false;
    "
    @keydown.escape.window="isOpen = false"
    class="relative z-50">

    <!-- Modal Backdrop -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm">
    </div>

    <!-- Modal Content -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 transform translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
         class="fixed inset-0 z-10 overflow-y-auto"
         @click.away="isOpen = false">
        
        <div class="flex items-center justify-center min-h-screen px-4 py-6">
            <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Success Message -->
                <div x-show="success" 
                     x-transition
                     class="absolute inset-0 z-10 flex items-center justify-center bg-white bg-opacity-90 backdrop-blur-sm">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 rounded-full bg-green-100 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Booking Confirmed!</h3>
                        <p class="text-gray-600">Check your email for confirmation details.</p>
                    </div>
                </div>

                <!-- Modal Header -->
                <div class="relative h-48">
                    <img :src="service?.image" 
                         :alt="service?.name"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <button @click="isOpen = false" 
                            class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="absolute bottom-4 left-6 text-white">
                        <h3 class="text-2xl font-bold" x-text="service?.name"></h3>
                        <p class="text-sm opacity-90" x-text="service?.description"></p>
                        <div class="flex items-baseline mt-2">
                            <span class="text-sm opacity-75">From</span>
                            <span class="text-2xl font-bold ml-2" x-text="'$' + service?.price"></span>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div x-show="error" 
                     x-transition
                     class="p-4 bg-red-50 border-l-4 border-red-500">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700" x-text="error"></p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button @click="error = null" class="text-red-400 hover:text-red-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <form @submit.prevent="submitForm" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" 
                                   x-model="form.name"
                                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                   :disabled="loading"
                                   required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" 
                                   x-model="form.email"
                                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                   :disabled="loading"
                                   required>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" 
                                   x-model="form.phone"
                                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                   :disabled="loading"
                                   required>
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Date</label>
                            <input type="date" 
                                   x-model="form.date"
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                   :disabled="loading"
                                   required>
                        </div>

                        <!-- Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Time</label>
                            <select x-model="form.time"
                                    class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                    :disabled="loading"
                                    required>
                                <option value="">Select a time</option>
                                <template x-for="slot in timeSlots" :key="slot">
                                    <option :value="slot" x-text="slot"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Special Notes</label>
                            <textarea x-model="form.notes"
                                      class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 resize-none"
                                      rows="3"
                                      :disabled="loading"
                                      placeholder="Any special requests or notes..."></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="relative px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                :disabled="loading">
                            <span x-show="!loading">Confirm Booking</span>
                            <span x-show="loading" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
