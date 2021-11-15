<?php
namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;

interface ChatControllerInterface
{
	public function index();

	public function contactsList();

	public function show(Chat $chat): ChatResource;

	public function unreadMessagesCount();

	public function sendMessage(SendMessageRequest $request);
}
