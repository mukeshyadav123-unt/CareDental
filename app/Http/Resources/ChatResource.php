<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\Chat */
class ChatResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'last_message_at' => $this->updated_at,
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
            'other_sender' => $this->getSender(),
        ];
    }

    private function getSender()
    {
        if (auth()->user()->type == 'doctor') {
            return new PatientResource($this->whenLoaded('patient'));
        } else {
            return new DoctorResource($this->whenLoaded('doctor'));
        }
    }
}
