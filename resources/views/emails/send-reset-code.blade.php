@component('mail::message')
# Reset Password Notification
## You are receiving this email because we received a password reset request for your account.
## **{{$code}}**
## This password reset code  will expire in 10 minutes.

## If you did not request a password reset, no further action is required.

Thanks,<br>
    {{ config('app.name') }}
@endcomponent
