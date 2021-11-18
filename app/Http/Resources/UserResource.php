<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'created_at' => optional($this->created_at)->diffForHumans(),
            "unread_messages_count" => $this->unread_messages_count ?? new MissingValue,
            'chat_id' => optional($this->chats->first())->id

        ];
    }
}
