@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Booking Management</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.bookings.calendar') }}" class="btn btn-outline">
                Calendar View
            </a>
            <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
                New Booking
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Date Range</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Specialist</label>
                <select name="specialist_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">All Specialists</option>
                    @foreach($specialists as $specialist)
                        <option value="{{ $specialist->id }}" {{ request('specialist_id') == $specialist->id ? 'selected' : '' }}>
                            {{ $specialist->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn btn-secondary w-full">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialist</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($bookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $booking->confirmation_code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->customer_details['name'] ?? 'N/A' }}<br>
                            <span class="text-xs">{{ $booking->customer_details['email'] ?? '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->service->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->specialist->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->start_time->format('M j, Y g:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900">
                                    View
                                </a>
                                @if($booking->status === 'pending' || $booking->status === 'confirmed')
                                    <form action="{{ route('admin.bookings.status.update', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="completed" class="text-green-600 hover:text-green-900 ml-2">
                                            Complete
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.status.update', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="cancelled" class="text-red-600 hover:text-red-900 ml-2">
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No bookings found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>

@push('scripts')
<script>
    // Add any JavaScript needed for the booking management interface
    document.addEventListener('DOMContentLoaded', function() {
        // Handle status update confirmations
        const statusForms = document.querySelectorAll('form[action*="status"]');
        statusForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const status = this.querySelector('button[name="status"]').value;
                if (confirm(`Are you sure you want to mark this booking as ${status}?`)) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection 