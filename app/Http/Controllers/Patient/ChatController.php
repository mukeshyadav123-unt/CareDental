<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\ChatControllerInterface;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatMessageResource;
use App\Http\Resources\ChatResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserCollection;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ChatController extends Controller implements ChatControllerInterface
{
    public function index()
    {
        $patient = Patient::find(auth()->id());
        return ChatResource::collection($patient->chats()->with('doctor')->withCount('unreadMessages')->get());
    }

    public function contactsList()
    {
        $patient = Patient::find(auth()->id());
        $doctors = $patient->doctors()->distinct()->get();
        $doctors = $doctors->map(function (Doctor &$patient) {
            $patient->unread_messages_count = optional(Chat::where('patient_id', auth()->id())
                    ->where('doctor_id', $patient->id)
                    ->withCount('unreadMessages')
                    ->first())->unread_messages_count ?? 0;
            return $patient;
        });
        $admin = Admin::first();
        $admin->unread_messages_count = optional(Chat::where('doctor_id', auth()->id())
                ->whereNotNull('admin_id')->withCount('unreadMessages')->first())->unread_messages_count ?? 0;
        $doctors->push($admin);
        return new UserCollection($doctors);
    }

    public function show(Chat $chat): ChatResource
    {
        $chat->unreadMessages()->update(['seen_by_patient' => true]);

        $chat->load(['doctor', 'messages'])
            ->loadCount('unreadMessages');

        return new ChatResource($chat);
    }

    public function unreadMessagesCount()
    {
        $count = ChatMessage::query()->whereHas('chat', fn ($q) => $q->where('patient_id', auth()->id()))
            ->where('seen_by_patient', false)
            ->count();
        return response()->json([
            'count' => $count,
        ]);
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $patient = Patient::find(auth()->id());

        $receiver = $patient->doctors()->where('users.id', $request->input('receiver_id'))
            ->firstOrFail();
        $chat = Chat::query()
            ->firstOrCreate([
                'patient_id' => $patient->id,
                'doctor_id' => $receiver->id,
            ], []);
        $message = $chat->messages()->create([
            'from' => 'patient',
            'message' => $request->input('message'),
        ]);
        return new ChatMessageResource($message);
    }
}
