@component('mail::message')
# New Booking Received

A new booking has been made through GlamGo.

## Customer Details
**Name:** {{ $booking->user->name }}  
**Email:** {{ $booking->user->email }}  
**Phone:** {{ $booking->user->phone }}

## Booking Information
**Service:** {{ $booking->service->name }}  
**Date:** {{ $booking->appointment_datetime->format('l, F j, Y') }}  
**Time:** {{ $booking->appointment_datetime->format('g:i A') }}  
**Price:** ${{ number_format($booking->total_price, 2) }}

@if($booking->notes)
## Special Notes
{{ $booking->notes }}
@endif

@component('mail::button', ['url' => route('admin.bookings.show', $booking->id), 'color' => 'primary'])
View in Dashboard
@endcomponent

@component('mail::table')
| Booking Status | Payment Status |
| ------------- | -------------- |
| {{ ucfirst($booking->status) }} | {{ ucfirst($booking->payment_status) }} |
@endcomponent

Best regards,<br>
{{ config('app.name') }} System
@endcomponent
