<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientSignupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required' , 'min:2'],
            'email' => ['required' , 'email' , 'unique:users,email'],
            'phone_number' =>  ['required' , 'phone'],
            'age' => ['required' , 'numeric' , 'min:10'],
            'gender' => ['required']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
