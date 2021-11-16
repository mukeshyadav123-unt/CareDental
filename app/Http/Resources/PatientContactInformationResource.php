<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\PatientContactInformation */
class PatientContactInformationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'home_phone_number' => $this->home_phone_number,
            'work_phone_number' => $this->work_phone_number,
            'address' => $this->address,
            'temp_address' => $this->temp_address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'patient_id' => $this->patient_id,
            'patient' => new PatientResource($this->whenLoaded('patient')),
        ];
    }
}
