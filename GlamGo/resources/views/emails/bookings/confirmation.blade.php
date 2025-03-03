<x-mail::message>
# Booking Confirmation

Dear {{ $booking->customer_details['first_name'] }},

Thank you for booking with us! Your appointment has been confirmed.

## Booking Details

<x-mail::panel>
**Service:** {{ $booking->service->name }}  
**Specialist:** {{ $booking->specialist->name }}  
**Date:** {{ $booking->start_time->format('l, F j, Y') }}  
**Time:** {{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}  
**Duration:** {{ $booking->getDurationInMinutes() }} minutes  
**Confirmation Code:** {{ $booking->confirmation_code }}
</x-mail::panel>

@if($booking->addons->count() > 0)
## Add-on Services
<x-mail::panel>
@foreach($booking->addons as $addon)
- {{ $addon->name }} ({{ $addon->duration }} min) - ${{ number_format($addon->price, 2) }}
@endforeach
</x-mail::panel>
@endif

## Total Price
<x-mail::panel>
${{ number_format($booking->total_price, 2) }}
</x-mail::panel>

## Important Information
- Please arrive 10 minutes before your appointment
- Cancellations require 24 hours notice
- Your confirmation code is: {{ $booking->confirmation_code }}

<x-mail::button :url="$viewUrl">
View Booking Details
</x-mail::button>

## Location
<x-mail::panel>
{{ config('app.name') }}  
{{ config('app.address') }}  
{{ config('app.phone') }}
</x-mail::panel>

Need to make changes? Contact us as soon as possible.

Thanks,<br>
{{ config('app.name') }}

<x-slot:subcopy>
If you did not make this booking, please contact us immediately.
</x-slot:subcopy>
</x-mail::message> 