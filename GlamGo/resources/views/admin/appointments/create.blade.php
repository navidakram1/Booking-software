@extends('layouts.admin')

@section('title', 'New Appointment - GlamGo Admin')
@section('page-title', 'New Appointment')

@section('content')
<div class="container-fluid">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">New Appointment</h1>
            <p class="mt-1 text-sm text-gray-600">Create a new appointment for a customer</p>
        </div>

        <!-- Appointment Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <form action="{{ route('admin.appointments.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Customer Selection -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                    <select name="customer_id" id="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->email }})
                        </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service Selection -->
                <div>
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                    <select name="service_id" id="service_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} ({{ $service->duration }} mins - ${{ number_format($service->price, 2) }})
                        </option>
                        @endforeach
                    </select>
                    @error('service_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Staff Selection -->
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-700">Staff Member</label>
                    <select name="staff_id" id="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        <option value="">Select Staff Member</option>
                        @foreach($staff as $member)
                        <option value="{{ $member->id }}" {{ old('staff_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('staff_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date and Time Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="appointment_date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="appointment_date" id="appointment_date" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                            value="{{ old('appointment_date', date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            required>
                        @error('appointment_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="appointment_time" class="block text-sm font-medium text-gray-700">Time</label>
                        <input type="time" name="appointment_time" id="appointment_time" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                            value="{{ old('appointment_time') }}"
                            required>
                        @error('appointment_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes" id="notes" rows="3" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Add any special instructions or notes...">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                        Create Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any JavaScript for dynamic form behavior here
    // For example, you could add validation or dynamic time slot availability
});
</script>
@endpush
