<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowMyReportsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'doctor_id' => ['exists:users,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
