<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkVisitAsDoneRequest;
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
            ->when(request()->comming === "1", fn ($q) => $q->where('done', true))
            ->when(request()->comming === "0", fn ($q) => $q->where('done', false))
            ->orderByDesc('visits.created_at')
            ->get();
        return VisitResource::collection($times);
    }

    public function show(Visit $visit)
    {
        abort_if($visit->doctor_id != auth()->id(), 404, 'visit not found');
        $visit->load(['patient', 'doctor', 'doctorTime']);
        return new VisitResource($visit);
    }

    public function markDone(MarkVisitAsDoneRequest $request, Visit $visit)
    {
        abort_if($visit->doctor_id != auth()->id(), 404, 'visit not found');
        $visit->done = true;
        $visit->save();
        if ($request->filled('doctor_note')) {
            $visit->update(['doctor_note' => $request->doctor_note]);
        }
        $visit->load(['patient', 'doctor', 'doctorTime']);
        return new VisitResource($visit);
    }

    public function markNotDone(Visit $visit)
    {
        abort_if($visit->doctor_id != auth()->id(), 404, 'visit not found');
        $visit->done = false;
        $visit->save();
        $visit->load(['patient', 'doctor', 'doctorTime']);
        return new VisitResource($visit);
    }
}
