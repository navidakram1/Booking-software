@extends('layouts.admin')

@section('title', 'Appointment Calendar - GlamGo Admin')
@section('page-title', 'Appointment Calendar')

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
            <h1 class="text-2xl font-semibold text-gray-900">Appointment Calendar</h1>
            <p class="mt-1 text-sm text-gray-600">View and manage appointments in calendar view</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                <i class="fas fa-list mr-2"></i>
                List View
            </a>
            <a href="{{ route('admin.appointments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                <i class="fas fa-plus mr-2"></i>
                New Appointment
            </a>
        </div>
    </div>

    <!-- Calendar -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Appointment Details Modal -->
    <div class="fixed inset-0 overflow-y-auto hidden" id="appointmentModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Appointment Details
                            </h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Customer</label>
                                    <p class="mt-1 text-sm text-gray-900" id="modalCustomer"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Service</label>
                                    <p class="mt-1 text-sm text-gray-900" id="modalService"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Staff</label>
                                    <p class="mt-1 text-sm text-gray-900" id="modalStaff"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <p class="mt-1 text-sm" id="modalStatus"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <a href="#" id="modalEdit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pink-600 text-base font-medium text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Edit
                    </a>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
        events: @json($appointments),
        eventClick: function(info) {
            showAppointmentDetails(info.event);
        }
    });
    calendar.render();
});

function showAppointmentDetails(event) {
    document.getElementById('modalCustomer').textContent = event.extendedProps.customer;
    document.getElementById('modalService').textContent = event.extendedProps.service;
    document.getElementById('modalStaff').textContent = event.extendedProps.staff;
    
    const statusEl = document.getElementById('modalStatus');
    statusEl.textContent = event.extendedProps.status.charAt(0).toUpperCase() + event.extendedProps.status.slice(1);
    statusEl.className = 'mt-1 text-sm ' + getStatusColor(event.extendedProps.status);
    
    document.getElementById('modalEdit').href = `/admin/appointments/${event.id}/edit`;
    document.getElementById('appointmentModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('appointmentModal').classList.add('hidden');
}

function getStatusColor(status) {
    const colors = {
        'confirmed': 'text-green-600',
        'cancelled': 'text-red-600',
        'completed': 'text-blue-600',
        'no-show': 'text-yellow-600'
    };
    return colors[status] || 'text-gray-600';
}
</script>
@endpush
