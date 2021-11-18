<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user' => ['array'],
            'user.name' => ['min:1', 'sometimes'],
            'user.email' => ['min:1', 'email', 'sometimes'],
            'user.phone_number' => ['min:1', 'sometimes', 'unique:users,phone_number'],
            'user.birthday' => ['min:1', 'date'],
            'details' => ['array'],
            'details.specialty' => ['min:2'],
            'details.description' => ['min:2'],
            'details.address' => ['min:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
