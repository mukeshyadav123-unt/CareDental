<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Doctor */
class DoctorResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
	    'is_verified' => $this->is_verified,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'type' => $this->type,
            'birthday' => $this->birthday,
            'created_at' => optional($this->created_at)->diffForHumans(),
            'details' => new DoctorDetailsResource ($this->whenLoaded('details')),
            'times' => new DoctorTimesCollection($this->whenLoaded('times')),
            'reviews' => VisitReviewResource::collection($this->whenLoaded('reviews')),
            'reviews_avg_rate' => round((float) $this->reviews_avg_rate, 2),
        ];
    }
}
