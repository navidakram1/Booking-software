@extends('layouts.admin')

@section('title', 'Booking Calendar - GlamGo Admin')
@section('page-title', 'Booking Calendar')

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
.fc-event {
    cursor: pointer;
}
.fc-event:hover {
    opacity: 0.9;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Booking Calendar</h1>
            <p class="mt-1 text-sm text-gray-600">View and manage bookings in calendar view</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                <i class="fas fa-list mr-2"></i>
                List View
            </a>
            <a href="{{ route('admin.bookings.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                <i class="fas fa-plus mr-2"></i>
                New Booking
            </a>
        </div>
    </div>

    <!-- Calendar -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <div id="calendar"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: @json($bookings),
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short'
        }
    });
    calendar.render();
});
</script>
@endpush
@endsection
