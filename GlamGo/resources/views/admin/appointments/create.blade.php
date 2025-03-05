@extends('layouts.admin')

@section('title', 'Create Appointment - GlamGo Admin')
@section('page-title', 'Create Appointment')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl p-8 shadow-sm">
        <form action="{{ route('admin.appointments.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Customer Selection -->
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                <select name="customer_id" id="customer_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 rounded-md" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Service Selection -->
            <div>
                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">Service</label>
                <select name="service_id" id="service_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 rounded-md" required>
                    <option value="">Select Service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }} - {{ $service->formatted_price }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Staff Selection -->
            <div>
                <label for="staff_id" class="block text-sm font-medium text-gray-700 mb-2">Staff Member</label>
                <select name="staff_id" id="staff_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 rounded-md" required>
                    <option value="">Select Staff Member</option>
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date & Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                    <input type="date" name="appointment_date" id="appointment_date" class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 rounded-md" required>
                </div>
                <div>
                    <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                    <input type="time" name="appointment_time" id="appointment_time" class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 rounded-md" required>
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 rounded-md"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Create Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointment_date').min = today;

    // Update staff options based on selected service
    const serviceSelect = document.getElementById('service_id');
    const staffSelect = document.getElementById('staff_id');
    const staffMembers = @json($staff);

    serviceSelect.addEventListener('change', function() {
        const selectedServiceId = this.value;
        staffSelect.innerHTML = '<option value="">Select Staff Member</option>';

        if (selectedServiceId) {
            staffMembers.forEach(member => {
                if (member.services.some(service => service.id == selectedServiceId)) {
                    const option = new Option(member.name, member.id);
                    staffSelect.add(option);
                }
            });
        }
    });
});
</script>
@endpush
