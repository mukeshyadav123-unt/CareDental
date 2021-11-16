<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorTimeRequest;
use App\Http\Resources\DoctorTimesCollection;
use App\Http\Resources\DoctorTimesResource;
use App\Models\Doctor;
use App\Models\DoctorTimes;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
        return new DoctorTimesCollection($times);
    }

    public function store(StoreDoctorTimeRequest $request)
    {
        $doctor = Doctor::find(auth()->id());
        $overlappingTimes = DoctorTimes::query()
            ->where('doctor_id', auth()->id())
            ->where('date', $request->date)
            ->where(
                fn ($q) => $q->where('from', '>=', Carbon::parse($request->from)->toTimeString())
                    ->where('to', '>=', Carbon::parse($request->to)->toTimeString())
            )
            ->count();
        abort_if($overlappingTimes, '400', 'cannot do overlapping times');
        $time = $doctor->times()->create($request->validated());
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
