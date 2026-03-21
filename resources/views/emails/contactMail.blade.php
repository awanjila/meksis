<html>
@component('mail::message')
# New Contact Form Submission

**From:** {{ $data['name'] }}

@if(isset($data['company']) && $data['company'])
**Company:** {{ $data['company'] }}
@endif

**Email:** {{ $data['email'] }}

**Phone:** {{ $data['phone'] }}

@if(isset($data['subject']) && $data['subject'])
**Subject:** {{ $data['subject'] }}
@endif

---

**Message:**

{{ $data['message'] }}

---

@component('mail::button', ['url' => 'mailto:'.$data['email']])
Reply to {{ $data['name'] }}
@endcomponent

Best regards,<br>
**{{ $data['name'] }}**

---
*This message was sent via the contact form at {{ config('app.name') }}*
@endcomponent
</html>
