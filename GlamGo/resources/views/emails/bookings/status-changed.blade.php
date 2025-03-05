<x-mail::message>
# Booking Status Update

Dear {{ $booking->customer_details['first_name'] }},

{{ $message }}

## Booking Details

<x-mail::panel>
**Service:** {{ $booking->service->name }}  
**Specialist:** {{ $booking->specialist->name }}  
**Date:** {{ $booking->start_time->format('l, F j, Y') }}  
**Time:** {{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}  
**Status:** {{ ucfirst($booking->status) }}  
**Confirmation Code:** {{ $booking->confirmation_code }}
</x-mail::panel>

@if($booking->status === 'cancelled')
## Cancellation Policy
If you would like to book another appointment, please visit our website or contact us directly.
@endif

<x-mail::button :url="$viewUrl">
View Booking Details
</x-mail::button>

## Need Help?
<x-mail::panel>
Contact us at:  
{{ config('app.phone') }}  
{{ config('app.email') }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}

<x-slot:subcopy>
If you did not make this booking, please contact us immediately.
</x-slot:subcopy>
</x-mail::message> 