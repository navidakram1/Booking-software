@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notification Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.notifications.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Email Notifications -->
                        <div class="mb-4">
                            <h4>Email Notifications</h4>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="email_booking_confirmation" name="email_booking_confirmation" {{ setting('email_booking_confirmation') ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_booking_confirmation">Send Booking Confirmation</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="email_booking_reminder" name="email_booking_reminder" {{ setting('email_booking_reminder') ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_booking_reminder">Send Booking Reminder</label>
                            </div>
                            <div class="form-group">
                                <label for="email_reminder_hours">Reminder Hours Before Appointment</label>
                                <input type="number" class="form-control" id="email_reminder_hours" name="email_reminder_hours" value="{{ old('email_reminder_hours', setting('email_reminder_hours')) }}" min="1" max="72">
                            </div>
                        </div>

                        <!-- SMS Notifications -->
                        <div class="mb-4">
                            <h4>SMS Notifications</h4>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="sms_booking_confirmation" name="sms_booking_confirmation" {{ setting('sms_booking_confirmation') ? 'checked' : '' }}>
                                <label class="form-check-label" for="sms_booking_confirmation">Send Booking Confirmation</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="sms_booking_reminder" name="sms_booking_reminder" {{ setting('sms_booking_reminder') ? 'checked' : '' }}>
                                <label class="form-check-label" for="sms_booking_reminder">Send Booking Reminder</label>
                            </div>
                            <div class="form-group">
                                <label for="sms_reminder_hours">Reminder Hours Before Appointment</label>
                                <input type="number" class="form-control" id="sms_reminder_hours" name="sms_reminder_hours" value="{{ old('sms_reminder_hours', setting('sms_reminder_hours')) }}" min="1" max="72">
                            </div>
                        </div>

                        <!-- Push Notifications -->
                        <div class="mb-4">
                            <h4>Push Notifications</h4>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="push_new_booking" name="push_new_booking" {{ setting('push_new_booking') ? 'checked' : '' }}>
                                <label class="form-check-label" for="push_new_booking">New Booking Notifications</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="push_booking_cancellation" name="push_booking_cancellation" {{ setting('push_booking_cancellation') ? 'checked' : '' }}>
                                <label class="form-check-label" for="push_booking_cancellation">Booking Cancellation Notifications</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
