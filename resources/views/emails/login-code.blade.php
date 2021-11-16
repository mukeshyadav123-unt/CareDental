@component('mail::message')
# Your Login code is:
## {{$code}}
The body of your message.

![alt text](https://caredentalhome.com/assets/img/logo-dark.png)

Thanks,<br>
{{ config('app.name') }}
@endcomponent
