<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $doctor = Doctor::find(auth()->id());
        return ChatResource::collection($doctor->chats()->with('patient')->get());
    }

    public function show(Chat $chat): ChatResource
    {
        $chat->load(['patient' , 'messages']);
        return new ChatResource($chat);
    }

}
