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
            'birthday' => ['required' , 'date' ],
            'gender' => ['required'],
            'password' => ['required' , 'confirmed']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
