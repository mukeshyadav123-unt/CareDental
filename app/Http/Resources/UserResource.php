<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
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
				'gender' => $this->gender,
				'phone_number' => $this->phone_number,
				'email' => $this->email,
				'birthday' => $this->birthday,
				'created_at' => $this->created_at->diffForHumans(),
		];
	}
}
