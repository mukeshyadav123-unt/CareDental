<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorTimesResource;
use App\Models\Doctor;
use App\Models\DoctorTimes;
use Illuminate\Http\Request;

class DoctorTimesController extends Controller
{
    public function index()
    {
        $doctor = Doctor::find(auth()->id());
        $times = $doctor
            ->times()
            ->orderBy('date')
            ->orderBy('from')
            ->orderBy('is_booked', 'desc')
            ->get();
        return DoctorTimesResource::collection($times);
    }

    public function store(Request $request)
    {
        $doctor = Doctor::find(auth()->id());
        $time = $doctor->times()->create($request->all());
        return new DoctorTimesResource($time);
    }

    public function show(DoctorTimes $time)
    {
        return new DoctorTimesResource($time);
    }


    public function update(Request $request, DoctorTimes $time)
    {
        $time->update($request->all());
        return new DoctorTimesResource($time);
    }


    public function destroy(DoctorTimes $time)
    {
        $time->delete();
        return response()->json([]);
    }
}
