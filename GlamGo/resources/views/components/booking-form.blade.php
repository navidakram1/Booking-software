@props(['services' => [], 'specialists' => []])

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Book an Appointment</h2>
    
    <form action="{{ route('booking.store') }}" method="POST" class="space-y-6" id="bookingForm">
        @csrf
        
        <!-- Service Selection -->
        <div>
            <label for="service" class="block text-sm font-medium text-gray-700">Select Service</label>
            <select name="service_id" id="service" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="">Choose a service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" data-duration="{{ $service->duration }}">
                        {{ $service->name }} - {{ $service->duration }}min ({{ $service->price }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Specialist Selection -->
        <div>
            <label for="specialist" class="block text-sm font-medium text-gray-700">Select Specialist</label>
            <select name="specialist_id" id="specialist" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="">Choose a specialist</option>
            </select>
        </div>

        <!-- Date Selection -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
            <input type="date" name="date" id="date" min="{{ date('Y-m-d') }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        </div>

        <!-- Time Slots -->
        <div>
            <label for="time" class="block text-sm font-medium text-gray-700">Select Time</label>
            <select name="time" id="time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="">Choose a time slot</option>
            </select>
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Special Requests/Notes</label>
            <textarea name="notes" id="notes" rows="3" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"></textarea>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                Book Appointment
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service');
    const specialistSelect = document.getElementById('specialist');
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');

    // Update specialists when service changes
    serviceSelect.addEventListener('change', function() {
        const serviceId = this.value;
        if (!serviceId) return;

        fetch(`/booking/specialists/${serviceId}`)
            .then(response => response.json())
            .then(data => {
                specialistSelect.innerHTML = '<option value="">Choose a specialist</option>';
                data.forEach(specialist => {
                    specialistSelect.innerHTML += `<option value="${specialist.id}">${specialist.name}</option>`;
                });
            });
    });

    // Update time slots when date or specialist changes
    function updateTimeSlots() {
        const serviceId = serviceSelect.value;
        const specialistId = specialistSelect.value;
        const date = dateInput.value;

        if (!serviceId || !specialistId || !date) return;

        fetch(`/booking/time-slots?service_id=${serviceId}&specialist_id=${specialistId}&date=${date}`)
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = '<option value="">Choose a time slot</option>';
                data.forEach(slot => {
                    timeSelect.innerHTML += `<option value="${slot}">${slot}</option>`;
                });
            });
    }

    specialistSelect.addEventListener('change', updateTimeSlots);
    dateInput.addEventListener('change', updateTimeSlots);
});
</script>
@endpush 