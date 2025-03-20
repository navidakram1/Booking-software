@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">Welcome back, {{ auth()->user()->name }}!</h2>
                        <p class="mt-1 text-gray-600">Here's what's happening with your appointments</p>
                    </div>
                    <a href="{{ route('booking.create') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 focus:bg-pink-700 active:bg-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Book New Appointment
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Upcoming Appointments -->
            <div class="col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Appointments</h3>
                    @if($upcomingBookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingBookings as $booking)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $booking->service->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $booking->scheduled_at->format('l, F j, Y') }}</p>
                                        <p class="text-sm text-gray-600">{{ $booking->scheduled_at->format('g:i A') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('booking.show', $booking) }}" class="text-pink-600 hover:text-pink-800">View Details</a>
                                        @if($booking->canCancel())
                                            <button onclick="cancelBooking({{ $booking->id }})" class="text-red-600 hover:text-red-800">Cancel</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No upcoming appointments. Why not book one now?</p>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Your Stats</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600">Total Appointments</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalBookings }}</p>
                        </div>
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600">Loyalty Points</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $loyaltyPoints }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Member Since</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ auth()->user()->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Favorites -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @foreach($recentActivity as $activity)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                @if($activity->type === 'booking')
                                    <svg class="h-6 w-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @else
                                    <svg class="h-6 w-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">{{ $activity->description }}</p>
                                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Favorite Services -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Favorite Services</h3>
                    @if($favoriteServices->count() > 0)
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($favoriteServices as $service)
                            <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                                <div class="flex items-center space-x-3">
                                    @if($service->image)
                                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}" class="h-12 w-12 rounded-full object-cover">
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $service->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $service->duration }} min • ${{ number_format($service->price, 2) }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('booking.create', ['service' => $service->id]) }}" class="inline-flex items-center px-3 py-1 border border-pink-600 rounded-md text-sm font-medium text-pink-600 hover:bg-pink-50">
                                    Book Now
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No favorite services yet. Browse our services and add some to your favorites!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function cancelBooking(bookingId) {
        if (confirm('Are you sure you want to cancel this appointment?')) {
            // Send AJAX request to cancel booking
            fetch(`/booking/${bookingId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Could not cancel the appointment. Please try again.');
                }
            });
        }
    }
</script>
@endpush
