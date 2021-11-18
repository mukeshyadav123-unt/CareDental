<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MissingValue;

/** @mixin \App\Models\Patient */
class PatientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'details' => new PatientDetailsResource($this->whenLoaded('details')),
            'contact_information' => new PatientContactInformationResource($this->whenLoaded('contactInformation')),
            'chats' => ChatResource::collection($this->whenLoaded('chats')),
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
            'reports' => ReportResource::collection($this->whenLoaded('reports')),
            'visits' => VisitResource::collection($this->whenLoaded('visits')),
        ];
    }
}
