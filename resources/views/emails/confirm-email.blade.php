@component('mail::message')
    # Appointment Details

    ## Visit
    @foreach($visit as $key => $value)
        * *{{$key}}* : {{$value}}
    @endforeach

    ## Patient
    @foreach($patient as $key => $value)
        @if (is_object($value) &&   (get_class($value)   != \Carbon\Carbon::class || get_class($value)   != \Illuminate\Support\Carbon::class  ) )
            @continue
        @endif
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
