<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Visit */
class VisitResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'doctorTime' => new DoctorTimesResource($this->whenLoaded('doctorTime')),
            'patient' => new PatientResource($this->whenLoaded('patient')),
        ];
    }
}
