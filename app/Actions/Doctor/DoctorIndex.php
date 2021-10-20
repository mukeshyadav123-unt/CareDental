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
        ray()->showQueries();
        return DoctorResource::collection(
            Doctor::with('details')
            ->filter($filters)
            ->paginate());
    }
}
