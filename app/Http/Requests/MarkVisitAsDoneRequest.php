<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkVisitAsDoneRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'doctor_note' => ['sometimes'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
