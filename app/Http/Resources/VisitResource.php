<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Visit */
class VisitResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'notes' => $this->notes,
            'done' => $this->done,
            'can_review' => $this->can_review,
            'created_at' => optional($this->created_at)->diffForHumans(),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'doctorTime' => new DoctorTimesResource($this->whenLoaded('doctorTime')),
            'patient' => new PatientResource($this->whenLoaded('patient')),
        ];
    }
}
