<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\ChatControllerInterface;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatMessageResource;
use App\Http\Resources\ChatResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserCollection;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ChatController extends Controller implements ChatControllerInterface
{
    public function index()
    {
        $doctor = Doctor::find(auth()->id());
        return ChatResource::collection($doctor->chats()->with('patient')->withCount('unreadMessages')->get());
    }

    public function unreadMessagesCount()
    {
        $count = ChatMessage::query()->whereHas('chat', fn ($q) => $q->where('doctor_id', auth()->id()))
            ->where('seen_by_doctor', false)
            ->count();
        return response()->json([
            'count' => $count,
        ]);
    }

    public function show(Chat $chat): ChatResource
    {
        $chat->unreadMessages()->update(['seen_by_doctor' => true]);
        $chat->load(['patient', 'messages'])
            ->loadCount('unreadMessages');

        return new ChatResource($chat);
    }

    public function contactsList()
    {
        $doctor = Doctor::find(auth()->id());
        return new UserCollection(DoctorResource::collection($doctor->patients));
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $doctor = Doctor::find(auth()->id());

        $receiver = $doctor->patients()->where('users.id', $request->input('receiver_id'))
            ->firstOrFail();
        $chat = Chat::query()
            ->where('doctor_id', $doctor->id)
            ->where('patient_id', $receiver->id)
            ->firstOrCreate();
        $message = $chat->messages()->create([
            'from' => 'doctor',
            'message' => $request->input('message'),
        ]);
        return new ChatMessageResource($message);
    }
}
