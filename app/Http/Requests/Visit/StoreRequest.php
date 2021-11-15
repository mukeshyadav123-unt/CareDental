<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'doctor_time_id' => ['required', 'exists:doctor_times,id'],
            'notes' => ['sometimes']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
