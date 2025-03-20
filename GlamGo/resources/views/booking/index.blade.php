@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12" x-data="bookingForm()">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Progress Bar -->
            <div class="bg-pink-50 px-8 py-4">
                <div class="flex justify-between">
                    <div class="flex items-center" :class="{'text-pink-600': step >= 1, 'text-gray-400': step < 1}">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center" 
                             :class="{'bg-pink-600 text-white': step >= 1, 'bg-gray-200': step < 1}">1</div>
                        <span class="ml-2 font-medium">Service</span>
                    </div>
                    <div class="flex items-center" :class="{'text-pink-600': step >= 2, 'text-gray-400': step < 2}">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center"
                             :class="{'bg-pink-600 text-white': step >= 2, 'bg-gray-200': step < 2}">2</div>
                        <span class="ml-2 font-medium">Date & Time</span>
                    </div>
                    <div class="flex items-center" :class="{'text-pink-600': step >= 3, 'text-gray-400': step < 3}">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center"
                             :class="{'bg-pink-600 text-white': step >= 3, 'bg-gray-200': step < 3}">3</div>
                        <span class="ml-2 font-medium">Details</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" class="p-8">
                @csrf
                
                <!-- Step 1: Service Selection -->
                <div x-show="step === 1" class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900">Choose Your Service</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($services as $service)
                        <div class="relative">
                            <input type="radio" name="service_id" id="service_{{ $service->id }}" 
                                   value="{{ $service->id }}" class="peer hidden" required>
                            <label for="service_{{ $service->id }}" 
                                   class="block p-4 border-2 rounded-xl cursor-pointer transition-all
                                          peer-checked:border-pink-500 peer-checked:bg-pink-50 hover:border-pink-200">
                                <h3 class="font-semibold text-lg">{{ $service->name }}</h3>
                                <p class="text-gray-600 mt-1">{{ $service->description }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-pink-600 font-medium">{{ $service->getFormattedPrice() }}</span>
                                    <span class="text-gray-500">{{ $service->duration }} min</span>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="button" @click="nextStep" 
                                class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                            Continue
                        </button>
                    </div>
                </div>

                <!-- Step 2: Date & Time Selection -->
                <div x-show="step === 2" class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900">Select Date & Time</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                            <input type="date" name="booking_date" required 
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-2 border-2 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Time</label>
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($timeSlots as $slot)
                                <div class="relative">
                                    <input type="radio" name="booking_time" id="time_{{ $slot }}" 
                                           value="{{ $slot }}" class="peer hidden" required>
                                    <label for="time_{{ $slot }}" 
                                           class="block text-center py-2 border-2 rounded-lg cursor-pointer transition-all
                                                  peer-checked:border-pink-500 peer-checked:bg-pink-50 hover:border-pink-200">
                                        {{ $slot }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between">
                        <button type="button" @click="prevStep" 
                                class="text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                            Back
                        </button>
                        <button type="button" @click="nextStep" 
                                class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                            Continue
                        </button>
                    </div>
                </div>

                <!-- Step 3: Personal Details -->
                <div x-show="step === 3" class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900">Your Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                            <input type="text" name="customer_name" required 
                                   class="w-full px-4 py-2 border-2 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="Enter your full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="customer_email" required 
                                   class="w-full px-4 py-2 border-2 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="Enter your email">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" name="customer_phone" required 
                                   class="w-full px-4 py-2 border-2 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="Enter your phone number">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests (Optional)</label>
                            <textarea name="notes" rows="3" 
                                      class="w-full px-4 py-2 border-2 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                      placeholder="Any special requests or notes"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between">
                        <button type="button" @click="prevStep" 
                                class="text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                            Back
                        </button>
                        <button type="submit" 
                                class="bg-pink-600 text-white px-8 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                            Book Appointment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function bookingForm() {
    return {
        step: 1,
        nextStep() {
            if (this.validateStep()) {
                this.step++;
            }
        },
        prevStep() {
            this.step--;
        },
        validateStep() {
            if (this.step === 1) {
                return document.querySelector('input[name="service_id"]:checked');
            }
            if (this.step === 2) {
                return document.querySelector('input[name="booking_date"]').value && 
                       document.querySelector('input[name="booking_time"]:checked');
            }
            return true;
        }
    }
}
</script>
@endpush

@endsection 