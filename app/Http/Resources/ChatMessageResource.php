<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\ChatMessage */
class ChatMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from_you' => $this->from == auth()->user()->type,
            'message' => $this->message,
            'created_at' => optional($this->created_at)->diffForHumans(null, null, false, 2),
            'chat_id' => $this->chat_id,

            'chat' => new ChatResource($this->whenLoaded('chat')),
        ];
    }
}
