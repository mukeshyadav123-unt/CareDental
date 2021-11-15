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
        $users = User::query()->where('type', '!=', 'admin')->get();
        return new UserCollection(UserResource::collection($users));
    }

    public function show(Chat $chat): ChatResource
    {
        $chat->unreadMessages()->update(['seen' => true]);

        $chat->load(['doctor', 'messages'])
            ->loadCount('unreadMessages');

        return new ChatResource($chat);
    }

    public function unreadMessagesCount()
    {
        $count = ChatMessage::query()
            ->whereHas('chat', fn ($q) => $q->where('admin_id', auth()->id()))
            ->where('seen', false)
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
