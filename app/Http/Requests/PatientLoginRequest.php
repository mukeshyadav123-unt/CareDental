<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientLoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['email' , 'required' , 'exists:users,email'],
            'password' => ['min:6' ,'required'],
//            'user_type'=> ['required']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
