<?php

namespace App\Jobs;

use App\Http\Resources\DoctorResource;
use App\Http\Resources\DoctorTimesResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\VisitResource;
use App\Mail\ConfirmEmailMail;
use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendVisitConfirmationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $visitId;

    public function __construct($visitId)
    {
        $this->visitId = $visitId;
    }

    public function handle()
    {
        $visit = Visit::query()->find($this->visitId);
        $doctor = $visit->doctor;
        $patient = $visit->patient;
        $time = $visit->doctorTime;
        $visit->unsetRelations();
        $doctor->unsetRelations();
        $doctor = (new DoctorResource($doctor))->toArray(null);
        unset($doctor['times']);
        unset($doctor['details']);
        unset($doctor['reviews']);
        $time = (new DoctorTimesResource($time))->toArray(null);
        unset($time['doctor']);

        $visit = (new VisitResource($visit))->toArray(null);
        unset($visit['doctor']);
        unset($visit['doctorTime']);
        unset($visit['patient']);
        $relations = $patient->getRelations();
        $patient = (new PatientResource($patient))->toArray(null);
        unset($patient['details']);
        Mail::to([$doctor, $patient])
            ->send(new ConfirmEmailMail([
            'visit' => $visit,
            'doctor' => $doctor,
            'patient' => $patient,
            'time' => $time,
        ]));
    }
}
