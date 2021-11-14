<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $patient = Patient::find(auth()->id());
        return ChatResource::collection($patient->chats()->with('doctor')->get());
    }

    public function show(Chat $chat): ChatResource
    {
        $chat->load(['doctor', 'messages']);
        return new ChatResource($chat);
    }
}
