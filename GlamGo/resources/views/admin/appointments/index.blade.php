@extends('layouts.admin')

@section('title', 'Appointments - GlamGo Admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Appointments</h1>
        <a href="{{ route('admin.appointments.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
            Create Appointment
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form action="{{ route('admin.appointments.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Date Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Service -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                    <select name="service_id" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200">
                        <option value="">All Services</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Staff -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Staff</label>
                    <select name="staff_id" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200">
                        <option value="">All Staff</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}" {{ request('staff_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search Customer</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email"
                        class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200">
                </div>
            </div>

            <div class="flex items-center justify-between pt-4">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                    Apply Filters
                </button>
                <a href="{{ route('admin.appointments.index') }}" class="text-gray-600 hover:text-gray-900">
                    Clear Filters
                </a>
                <a href="{{ route('admin.appointments.export', request()->query()) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Export CSV
                </a>
            </div>
        </form>
    </div>

    <!-- Appointments List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Staff</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($appointments as $appointment)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-pink-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-pink-600">
                                            {{ strtoupper(substr($appointment->customer->name ?? '', 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $appointment->customer->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $appointment->customer->email ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $appointment->service->name ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $appointment->service->duration ?? 0 }} min</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $appointment->staff->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $appointment->formatted_date }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($appointment->status === 'completed') bg-green-100 text-green-800
                                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                    @elseif($appointment->status === 'confirmed') bg-blue-100 text-blue-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ $appointment->formatted_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">${{ $appointment->formatted_amount }}</div>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.appointments.edit', $appointment) }}" 
                                        class="text-pink-600 hover:text-pink-900">Edit</a>
                                    <form action="{{ route('admin.appointments.destroy', $appointment) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this appointment?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No appointments found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
