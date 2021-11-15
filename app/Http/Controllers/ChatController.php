<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\ChatControllerInterface;
use App\Http\Controllers\Patient\ChatController as PatientChatController;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;

class ChatController extends Controller implements ChatControllerInterface
{
    protected ChatControllerInterface $controller;

    public function index()
    {
        $this->controller = $this->getController();
        return $this->controller->index();
    }

    public function contactsList()
    {
        $this->controller = $this->getController();
        return $this->controller->contactsList();
    }

    public function show(Chat $chat): ChatResource
    {
        $this->controller = $this->getController();
        return $this->controller->show($chat);
    }

    public function unreadMessagesCount()
    {
        $this->controller = $this->getController();
        return $this->controller->unreadMessagesCount();
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $this->controller = $this->getController();
        return $this->controller->sendMessage($request);
    }

    private function getController(): ?ChatControllerInterface
    {
        if (auth()->user()->type == 'doctor') {
            return $this->controller = new Doctor\ChatController();
        } elseif (auth()->user()->type == 'patient') {
            return $this->controller = new PatientChatController();
        } elseif (auth()->user()->type == 'admin') {
            return $this->controller = new Admin\ChatController();
        } else {
            abort(404);
        }
        return null;
    }
}
