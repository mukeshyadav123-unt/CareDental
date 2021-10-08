<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorLoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['email' , 'required' , 'exists:users,email'],
            'password' => ['min:6' ,'required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
