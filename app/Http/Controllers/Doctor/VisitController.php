<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisitResource;
use App\Models\Doctor;
use App\Models\Visit;

class VisitController extends Controller
{
    public function index()
    {
        $doctor = Doctor::find(auth()->id());
        $times = $doctor
            ->visits()
            ->with(['patient', 'doctor', 'doctorTime'])
            ->get();
        return VisitResource::collection($times);
    }

    public function show(Visit $visit)
    {
        abort_if($visit->doctor_id != auth()->id(), 404, 'visit not found');
        $visit->load(['patient', 'doctor', 'doctorTime']);
        return new VisitResource($visit);
    }
}
