@component('mail::message')
# Booking Confirmation

Dear {{ $booking->user->name }},

Thank you for choosing GlamGo! Your booking has been confirmed.

## Booking Details

**Service:** {{ $booking->service->name }}  
**Date:** {{ $booking->appointment_datetime->format('l, F j, Y') }}  
**Time:** {{ $booking->appointment_datetime->format('g:i A') }}  
**Price:** ${{ number_format($booking->total_price, 2) }}

@component('mail::panel')
### Important Information
- Please arrive 10 minutes before your appointment
- Bring a valid ID for verification
- Payment will be collected at the salon
@endcomponent

@component('mail::button', ['url' => route('bookings.show', $booking->id), 'color' => 'primary'])
View Booking Details
@endcomponent

Need to make changes? You can manage your booking through our website or contact us directly.

@component('mail::table')
| Contact Information |                          |
| ------------------ | ------------------------ |
| Phone              | +1 (555) 123-4567        |
| Email              | contact@glamgo.com        |
| Address            | 123 Beauty Street, Suite 100, Los Angeles, CA 90001 |
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team

<small>This is an automated message. Please do not reply to this email.</small>
@endcomponent
