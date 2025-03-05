@extends('layouts.main')

@section('title', 'Book Appointment - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Booking Form -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">
                    <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                        Book Your Appointment
                    </span>
                </h1>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Service Selection -->
                    <div>
                        <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">Select Service</label>
                        <select id="service_id" name="service_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Choose a service...</option>
                            @foreach($services as $service)
                                <option value="{{ $service['id'] }}" data-duration="{{ $service['duration'] }}">
                                    {{ $service['name'] }} - ${{ number_format($service['price'], 2) }} ({{ $service['duration'] }} min)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Staff Selection -->
                    <div>
                        <label for="staff_id" class="block text-sm font-medium text-gray-700 mb-2">Select Staff</label>
                        <select id="staff_id" name="staff_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Choose a staff member...</option>
                            <option value="1">Sarah Johnson - Hair Stylist</option>
                            <option value="2">Michael Chen - Colorist</option>
                            <option value="3">Emma Davis - Nail Artist</option>
                        </select>
                    </div>

                    <!-- Date Selection -->
                    <div>
                        <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                        <input type="date" id="appointment_date" name="appointment_date" required
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Time Selection -->
                    <div>
                        <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">Select Time</label>
                        <select id="appointment_time" name="appointment_time" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Choose a time...</option>
                        </select>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                        <textarea id="notes" name="notes" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Any special requests or notes for your appointment..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition-all duration-300">
                            Book Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const staffSelect = document.getElementById('staff_id');
    const dateInput = document.getElementById('appointment_date');
    const timeSelect = document.getElementById('appointment_time');

    // Function to fetch available time slots
    function fetchAvailableSlots() {
        const service_id = serviceSelect.value;
        const staff_id = staffSelect.value;
        const date = dateInput.value;

        if (!service_id || !staff_id || !date) return;

        // Clear current options
        timeSelect.innerHTML = '<option value="">Loading available times...</option>';

        fetch(`/appointments/available-slots?service_id=${service_id}&staff_id=${staff_id}&date=${date}`)
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = '<option value="">Choose a time...</option>';
                data.slots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    timeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching available slots:', error);
                timeSelect.innerHTML = '<option value="">Error loading times</option>';
            });
    }

    // Add event listeners
    serviceSelect.addEventListener('change', fetchAvailableSlots);
    staffSelect.addEventListener('change', fetchAvailableSlots);
    dateInput.addEventListener('change', fetchAvailableSlots);
});
</script>
@endpush
