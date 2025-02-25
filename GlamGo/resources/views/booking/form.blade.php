@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Book an Appointment</h1>
        
        <form id="bookingForm" class="space-y-6">
            @csrf
            
            <!-- Service Selection -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="service">
                    Select Service
                </label>
                <select id="service" name="service_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Choose a service...</option>
                </select>
            </div>

            <!-- Specialist Selection -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="specialist">
                    Select Specialist
                </label>
                <select id="specialist" name="specialist_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Choose a specialist...</option>
                </select>
            </div>

            <!-- Date Selection -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Select Date
                </label>
                <input type="date" id="date" name="appointment_date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Time Slots -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="time">
                    Available Time Slots
                </label>
                <div id="timeSlots" class="grid grid-cols-4 gap-2">
                    <!-- Time slots will be populated dynamically -->
                </div>
            </div>

            <!-- Customer Information -->
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Your Name
                    </label>
                    <input type="text" id="name" name="customer_name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email Address
                    </label>
                    <input type="email" id="email" name="customer_email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone Number
                    </label>
                    <input type="tel" id="phone" name="customer_phone" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="special_requests">
                        Special Requests (Optional)
                    </label>
                    <textarea id="special_requests" name="special_requests" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Book Appointment
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load services
    fetch('/api/services')
        .then(response => response.json())
        .then(data => {
            const serviceSelect = document.getElementById('service');
            data.data.forEach(service => {
                const option = new Option(service.name, service.id);
                serviceSelect.add(option);
            });
        });

    // Load specialists
    fetch('/api/specialists')
        .then(response => response.json())
        .then(data => {
            const specialistSelect = document.getElementById('specialist');
            data.data.forEach(specialist => {
                const option = new Option(specialist.name, specialist.id);
                specialistSelect.add(option);
            });
        });

    // Check availability when date changes
    document.getElementById('date').addEventListener('change', checkAvailability);
    document.getElementById('specialist').addEventListener('change', checkAvailability);

    function checkAvailability() {
        const date = document.getElementById('date').value;
        const specialistId = document.getElementById('specialist').value;
        const serviceId = document.getElementById('service').value;

        if (!date || !specialistId || !serviceId) return;

        fetch(`/api/appointments/check-availability?date=${date}&specialist_id=${specialistId}&service_id=${serviceId}`)
            .then(response => response.json())
            .then(data => {
                const timeSlotsDiv = document.getElementById('timeSlots');
                timeSlotsDiv.innerHTML = '';
                
                data.data.forEach(slot => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'p-2 border rounded hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500';
                    button.textContent = slot.start_time;
                    button.onclick = () => selectTimeSlot(slot.start_time);
                    timeSlotsDiv.appendChild(button);
                });
            });
    }

    function selectTimeSlot(time) {
        // Remove active class from all buttons
        document.querySelectorAll('#timeSlots button').forEach(btn => {
            btn.classList.remove('bg-blue-500', 'text-white');
        });

        // Add active class to selected button
        event.target.classList.add('bg-blue-500', 'text-white');
        
        // Store selected time
        document.querySelector('input[name="appointment_time"]').value = time;
    }

    // Handle form submission
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('/api/appointments/book', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Appointment booked successfully!');
                window.location.href = '/appointments/confirmation/' + data.data.id;
            } else {
                alert(data.message || 'Something went wrong. Please try again.');
            }
        })
        .catch(error => {
            alert('An error occurred. Please try again.');
        });
    });
});
</script>
@endpush
