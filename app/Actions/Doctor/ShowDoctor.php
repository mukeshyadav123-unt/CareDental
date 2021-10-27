<?php

namespace App\Actions\Doctor;

use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Lorisleiva\Actions\Concerns\AsController;

class ShowDoctor
{
    use AsController;

    public function handle(Doctor $doctor)
    {
        $doctor->load(['details', 'times']);

        return new DoctorResource($doctor);
    }
}
