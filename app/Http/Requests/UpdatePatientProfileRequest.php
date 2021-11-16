<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'details' => ['array'],
            'details.preferred_first_name' => ['min:0', 'nullable'],
            'details.race' => ['min:0', 'nullable'],
            'details.ethnic_background' => ['min:0', 'nullable'],
            'details.religion' => ['min:0', 'nullable'],
            'details.marital_status' => ['min:0', 'nullable'],
            'details.ethnicity' => ['min:0', 'nullable'],
            'contact_information' => ['array'],
            'contact_information.home_phone_number' => ['min:1', 'nullable'],
            'contact_information.work_phone_number' => ['min:1', 'nullable'],
            'contact_information.address' => ['min:1', 'nullable'],
            'contact_information.temp_address' => ['min:1', 'nullable'],
            'user' => ['array'],
            'user.name' => ['min:1', 'sometimes'],
            'user.email' => ['min:1', 'email', 'sometimes'],
            'user.phone_number' => ['min:1', 'sometimes'],
            'user.birthday' => ['min:1', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
