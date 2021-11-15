<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\DoctorDetails */
class DoctorDetailsResource extends JsonResource
{
	/**
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
				'doctor_id' => $this->doctor_id,
				'specialty' => $this->specialty,
				'address' => $this->address,
				'description' => $this->description,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
		];
	}
}
