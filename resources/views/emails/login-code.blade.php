@component('mail::message')
# Your Login code is:
## {{$code}}
The body of your message.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
