<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\Admin */
class AdminResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'name' => 'Admin',
            'type' => 'admin',
        ];
    }
}
