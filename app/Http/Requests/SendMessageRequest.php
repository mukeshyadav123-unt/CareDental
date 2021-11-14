<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'receiver_id' => ['numeric', 'exists:users,id', 'required'],
            'message' => ['required', 'min:1'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
