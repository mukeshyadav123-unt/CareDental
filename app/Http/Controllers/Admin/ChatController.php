<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\ChatControllerInterface;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatMessageResource;
use App\Http\Resources\ChatResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

class ChatController extends Controller implements ChatControllerInterface
{
    public function index()
    {
        $chats = Chat::query()->whereNotNull('admin_id')
            ->with(['patient', 'doctor', 'messages'])
            ->withCount('unreadMessages')
            ->get();
        return ChatResource::collection($chats);
    }

    public function contactsList()
    {
        $doctors = Doctor::all();
        $doctors = $doctors->map(function (Doctor &$doctor) {
            $doctor->unread_messages_count = optional(Chat::whereNotNull('admin_id')
                    ->where('doctor_id', $doctor->id)
                    ->withCount('unreadMessages')
                    ->first())->unread_messages_count ?? 0;
            return $doctor;
        });
        $patients = Patient::all();
        $patients = $patients->map(function (Patient &$patient) {
            $patient->unread_messages_count = optional(Chat::whereNull('admin_id')
                    ->where('patient_id', $patient->id)
                    ->withCount('unreadMessages')
                    ->first())->unread_messages_count ?? 0;
            return $patient;
        });
        $doctors->each(function ($doctor) use ($patients) {
            $patients->push($doctor);
        });
        return new UserCollection($patients);
    }

    public function show(Chat $chat): ChatResource
    {
        $chat->unreadMessages()->update(['seen_by_admin' => true]);

        $chat->load(['doctor', 'messages'  => function($q) {
            return $q->orderBy('created_at');
        }])
            ->loadCount('unreadMessages');

        return new ChatResource($chat);
    }

    public function unreadMessagesCount()
    {
        $count = ChatMessage::query()
            ->whereHas('chat', fn ($q) => $q->where('admin_id', auth()->id()))
            ->where('seen_by_admin', false)
            ->count();
        return response()->json([
            'count' => $count,
        ]);
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $admin = Admin::find(auth()->id());

        $receiver = User::query()->where('users.id', $request->input('receiver_id'))
            ->where('type', '!=', 'admin')
            ->firstOrFail();
        $type = $receiver->type == 'patient' ? 'patient_id' : 'doctor_id';
        $chat = Chat::query()
            ->firstOrCreate([
                'admin_id' => $admin->id,
                $type => $receiver->id,
            ], []);
        $message = $chat->messages()->create([
            'from' => 'admin',
            'message' => $request->input('message'),
        ]);
        return new ChatMessageResource($message);
    }
}
