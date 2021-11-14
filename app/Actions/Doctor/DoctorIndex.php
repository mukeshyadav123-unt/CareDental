<?php

namespace App\Actions\Doctor;

use App\Filters\DoctorsFilters;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Lorisleiva\Actions\Concerns\AsController;

class DoctorIndex
{
    use AsController;

    public function handle()
    {
        $filters = new DoctorsFilters(request());

        return DoctorResource::collection(
            Doctor::with('details')
                ->withAvg('reviews', 'rate')
                ->filter($filters)
                ->paginate());
    }
}
