<?php

namespace App\Actions\Doctor;

use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Database\Query\Builder;
use Lorisleiva\Actions\Concerns\AsController;

class ShowDoctor
{
    use AsController;

    public function handle(Doctor $doctor)
    {
        $doctor->load([
            'details',
            'times' => function ($q) {
                return $q->where('date', '>=', now()->toDateString())->where('is_booked', false);
            },
            'reviews',
        ]);
        $doctor->loadAvg('reviews', 'rate');
        return new DoctorResource($doctor);
    }
}
