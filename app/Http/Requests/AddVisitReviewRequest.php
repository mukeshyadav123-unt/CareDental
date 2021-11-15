<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddVisitReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'between:1,5'],
            'comment' => ['sometimes', 'min:5'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
