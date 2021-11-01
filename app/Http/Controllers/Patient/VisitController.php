<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddVisitReviewRequest;
use App\Http\Requests\Visit\StoreRequest;
use App\Http\Resources\VisitResource;
use App\Http\Resources\VisitReviewResource;
use App\Jobs\SendVisitConfirmationEmailJob;
use App\Models\DoctorTimes;
use App\Models\Patient;
use App\Models\Visit;

class VisitController extends Controller
{
    public function index()
    {
        $patient = Patient::find(auth()->id());
        return VisitResource::collection($patient->visits()->with(['patient', 'doctor', 'doctorTime']));
    }

    public function show(Visit $visit)
    {
        $visit->load(['patient', 'doctor', 'doctorTime']);
        return new VisitResource($visit);
    }

    public function store(StoreRequest $request)
    {
        $patient = Patient::find(auth()->id());
        $doctorTime = DoctorTimes::findOrFail($request->doctor_time_id);
        abort_if($doctorTime->is_booked, 400, 'time is already booked');
        $visit = $patient->visits()->create([
            'doctor_id' => $doctorTime->doctor_id,
            'patient_id' => $patient->id,
            'doctor_time_id' => $doctorTime->id,
            'notes' => $request->notes,
        ]);
        $doctorTime->update(['is_booked' => true]);
        SendVisitConfirmationEmailJob::dispatch($visit->id);
        return $this->show($visit);
    }

    public function addReview(AddVisitReviewRequest $request, Visit $visit)
    {
        abort_if(!$visit->done, 400, 'visit has to be marked as done by the doctor first');
        abort_if($visit->patient_id != auth()->id(), 400, 'you can only review your visits');
        abort_if($visit->reviews()->exists(), 400, "You already added your review");
        $review = $visit->reviews()->create($request->validated());

        return new VisitReviewResource($review);
    }
}
