@extends('layouts.admin')

@section('title', 'Booking Calendar - GlamGo Admin')
@section('page-title', 'Booking Calendar')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/list/main.css" rel="stylesheet" />
<style>
.fc-event {
    cursor: pointer;
}
.fc-event:hover {
    opacity: 0.9;
}
.fc-toolbar-title {
    font-size: 1.5rem !important;
    font-weight: 600;
}
.fc-button {
    background-color: #4f46e5 !important;
    border-color: #4f46e5 !important;
}
.fc-button:hover {
    background-color: #4338ca !important;
    border-color: #4338ca !important;
}
.fc-button-active {
    background-color: #3730a3 !important;
    border-color: #3730a3 !important;
}
.booking-details {
    padding: 1rem;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.booking-details h3 {
    margin-bottom: 1rem;
    font-weight: 600;
}
.booking-details p {
    margin-bottom: 0.5rem;
}
.booking-details .badge {
    padding: 0.35rem 0.65rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Booking Calendar</h1>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Booking
        </a>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Staff</label>
                        <select id="staff-filter" class="form-select">
                            <option value="">All Staff</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <select id="service-filter" class="form-select">
                            <option value="">All Services</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="status-filter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="no_show">No Show</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="booking-details" class="card shadow mb-4 d-none">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
                </div>
                <div class="card-body">
                    <div class="booking-details">
                        <h3 id="booking-customer"></h3>
                        <p><strong>Service:</strong> <span id="booking-service"></span></p>
                        <p><strong>Staff:</strong> <span id="booking-staff"></span></p>
                        <p><strong>Time:</strong> <span id="booking-time"></span></p>
                        <p><strong>Duration:</strong> <span id="booking-duration"></span></p>
                        <p><strong>Amount:</strong> <span id="booking-amount"></span></p>
                        <p><strong>Status:</strong> <span id="booking-status"></span></p>
                        <div class="mt-3">
                            <a href="#" id="booking-edit" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" id="booking-cancel" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Event Details -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="booking-details">
                    <h3 id="modal-customer"></h3>
                    <p><strong>Service:</strong> <span id="modal-service"></span></p>
                    <p><strong>Staff:</strong> <span id="modal-staff"></span></p>
                    <p><strong>Time:</strong> <span id="modal-time"></span></p>
                    <p><strong>Duration:</strong> <span id="modal-duration"></span></p>
                    <p><strong>Amount:</strong> <span id="modal-amount"></span></p>
                    <p><strong>Status:</strong> <span id="modal-status"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="modal-edit" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'timeGridWeek',
        editable: true,
        droppable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        slotMinTime: '08:00:00',
        slotMaxTime: '20:00:00',
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short'
        },
        events: {
            url: '{{ route("admin.bookings.calendar.events") }}',
            failure: function() {
                alert('Error loading events');
            }
        },
        eventClick: function(info) {
            showEventDetails(info.event);
        },
        eventDrop: function(info) {
            updateEventTime(info.event, info.oldEvent);
        },
        eventResize: function(info) {
            updateEventDuration(info.event, info.oldEvent);
        },
        select: function(info) {
            window.location.href = '{{ route("admin.bookings.create") }}?' + 
                'scheduled_at=' + info.startStr;
        }
    });

    calendar.render();

    // Filter handling
    document.getElementById('staff-filter').addEventListener('change', function() {
        refreshCalendar();
    });

    document.getElementById('service-filter').addEventListener('change', function() {
        refreshCalendar();
    });

    document.getElementById('status-filter').addEventListener('change', function() {
        refreshCalendar();
    });

    function refreshCalendar() {
        var staff = document.getElementById('staff-filter').value;
        var service = document.getElementById('service-filter').value;
        var status = document.getElementById('status-filter').value;

        calendar.refetchEvents();
    }

    function showEventDetails(event) {
        var modal = new bootstrap.Modal(document.getElementById('eventModal'));
        
        document.getElementById('modal-customer').textContent = event.extendedProps.customer;
        document.getElementById('modal-service').textContent = event.extendedProps.service;
        document.getElementById('modal-staff').textContent = event.extendedProps.staff;
        document.getElementById('modal-time').textContent = event.start.toLocaleString();
        document.getElementById('modal-duration').textContent = event.extendedProps.duration;
        document.getElementById('modal-amount').textContent = event.extendedProps.amount;
        document.getElementById('modal-status').textContent = event.extendedProps.status;
        
        document.getElementById('modal-edit').href = '/admin/bookings/' + event.id + '/edit';
        
        modal.show();
    }

    function updateEventTime(event, oldEvent) {
        fetch('{{ route("admin.bookings.calendar.move") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: event.id,
                start: event.start.toISOString()
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                calendar.getEventById(event.id).setStart(oldEvent.start);
                alert('Failed to update booking time');
            }
        })
        .catch(error => {
            calendar.getEventById(event.id).setStart(oldEvent.start);
            alert('Error updating booking time');
        });
    }

    function updateEventDuration(event, oldEvent) {
        fetch('{{ route("admin.bookings.calendar.resize") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: event.id,
                start: event.start.toISOString(),
                end: event.end.toISOString()
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                calendar.getEventById(event.id).setEnd(oldEvent.end);
                alert('Failed to update booking duration');
            }
        })
        .catch(error => {
            calendar.getEventById(event.id).setEnd(oldEvent.end);
            alert('Error updating booking duration');
        });
    }
});
</script>
@endpush
