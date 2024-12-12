@component('mail::message')
# New Contact Form Submission

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Phone:** {{ $data['phone'] ?? 'Not provided' }}

**Message:**  
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
