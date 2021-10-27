<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\DoctorTimes */
class DoctorTimesResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'from' => $this->from,
            'to' => $this->to,
            'is_booked' => $this->is_booked,
            'created_at' => $this->created_at,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
        ];
    }
}
