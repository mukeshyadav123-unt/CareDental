<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSignupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required' , 'min:2'],
            'email' => ['required' , 'email' , 'unique:users,email'],
            'phone_number' =>  ['required' ,],
            'age' => ['required' , 'numeric' , 'min:10'],
            'gender' => ['required'],
            'password' => ['required' , 'confirmed']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
