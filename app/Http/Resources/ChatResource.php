<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\Chat */
class ChatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'last_message_at' => $this->updated_at,
            'from_admin' => $this->admin_id != null,
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
            'other_sender' => $this->getSender(),
            'unread_messages_count' => $this->unread_messages_count,
            'messages' => ChatMessageResource::collection($this->whenLoaded('messages')),
        ];
    }

    private function getSender()
    {
        if (auth()->user()->type == 'admin') {
            if ($this->patient_id) {
                return new PatientResource($this->whenLoaded('patient'));
            }
            return new DoctorResource($this->whenLoaded('doctor'));
        }
        if ($this->admin_id) {
            return [
                'name' => 'Admin',
                'type' => 'admin',
            ];
        }
        if (auth()->user()->type == 'doctor') {
            return new PatientResource($this->whenLoaded('patient'));
        } else {
            return new DoctorResource($this->whenLoaded('doctor'));
        }
    }
}
