@component('mail::message')
# Appointment Details

## Visit
@foreach($visit as $key => $value)
* *{{$key}}* : {{$value}}
@endforeach

## Patient
@foreach($patient as $key => $value)
* *{{$key}}* : {{$value}}
@endforeach

## Doctor
@foreach($doctor as $key => $value)
* *{{$key}}* : {{$value}}
@endforeach

## Time
@foreach($time as $key => $value)
* *{{$key}}* : {{$value}}
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
