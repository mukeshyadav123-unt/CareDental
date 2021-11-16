<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\PatientDetails */
class PatientDetailsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'preferred_first_name' => $this->preferred_first_name,
            'race' => $this->race,
            'ethnic_background' => $this->ethnic_background,
            'religion' => $this->religion,
            'marital_status' => $this->marital_status,
            'ethnicity' => $this->ethnicity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'patient_id' => $this->patient_id,

            'patient' => new PatientResource($this->whenLoaded('patient')),
        ];
    }
}
