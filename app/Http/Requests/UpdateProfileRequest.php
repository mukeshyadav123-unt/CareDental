<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current_password' => 'required',
            'email' => 'email',
            'name' => 'min:5',
            'new_password' => ['min:6', 'confirmed'],
            'gender' => ['in:male,female,other'],
            'phone_number' => ['min:3'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
