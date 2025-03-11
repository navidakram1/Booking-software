@extends('admin.layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Bookings
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">
                    Booking #{{ $booking->id }}
                </h1>
                <span class="px-3 py-1 text-sm font-semibold rounded-full
                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                    @elseif($booking->status === 'completed') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Customer Information -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Name</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->customer->name }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->customer->email }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Phone</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->customer->phone }}</div>
                    </div>
                </div>
            </div>

            <!-- Service Information -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Service Information</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Service</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->service->name }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Duration</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->service->duration }} minutes</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Staff Member</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->staff->name }}</div>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Appointment Details</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Date</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->start_time->format('F j, Y') }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Time</label>
                        <div class="mt-1 text-sm text-gray-900">
                            {{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Total Amount</label>
                        <div class="mt-1 text-sm text-gray-900">${{ number_format($booking->total_amount, 2) }}</div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Information</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Payment Status</label>
                        <div class="mt-1">
                            <span class="px-2 py-1 text-sm font-semibold rounded-full
                                @if($booking->payment_status === 'paid') bg-green-100 text-green-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>
                    </div>
                    @if($booking->notes)
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Notes</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="flex space-x-3">
                    @if($booking->status === 'pending')
                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Confirm Booking
                        </button>
                    </form>
                    @endif

                    @if($booking->status === 'confirmed')
                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            Mark as Completed
                        </button>
                    </form>
                    @endif

                    @if(in_array($booking->status, ['pending', 'confirmed']))
                    <button type="button" 
                            onclick="document.getElementById('reschedule-modal').classList.remove('hidden')"
                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                        Reschedule
                    </button>

                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="inline" id="cancel-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="button" 
                                onclick="document.getElementById('cancel-modal').classList.remove('hidden')"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                            Cancel Booking
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reschedule Modal -->
<div id="reschedule-modal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('admin.bookings.reschedule', $booking) }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Reschedule Booking</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">New Date & Time</label>
                            <input type="datetime-local" name="start_time" id="start_time" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="staff_id" class="block text-sm font-medium text-gray-700">Staff Member (Optional)</label>
                            <select name="staff_id" id="staff_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="{{ $booking->staff_id }}">{{ $booking->staff->name }} (Current)</option>
                                @foreach(App\Models\Staff::where('id', '!=', $booking->staff_id)->get() as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm Reschedule
                    </button>
                    <button type="button" onclick="document.getElementById('reschedule-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div id="cancel-modal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="cancelled">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Cancel Booking</h3>
                    <div>
                        <label for="cancellation_reason" class="block text-sm font-medium text-gray-700">Cancellation Reason</label>
                        <textarea name="cancellation_reason" id="cancellation_reason" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  required></textarea>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm Cancellation
                    </button>
                    <button type="button" onclick="document.getElementById('cancel-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date for rescheduling to today
    const today = new Date();
    today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
    document.getElementById('start_time').min = today.toISOString().slice(0, 16);
    
    // Calculate end time based on service duration
    const serviceDuration = {{ $booking->service->duration }};
    document.getElementById('start_time').addEventListener('change', function(e) {
        const startTime = new Date(e.target.value);
        const endTime = new Date(startTime.getTime() + serviceDuration * 60000);
        document.querySelector('input[name="end_time"]').value = endTime.toISOString().slice(0, 16);
    });
});
</script>
@endsection 