<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorTimeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "date" => ['required', 'date', 'after_or_equal:today'],
            "from" => ['required'],
            "to" => ['required'],
            "type" => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
