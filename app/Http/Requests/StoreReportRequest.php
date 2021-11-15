<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'numeric'],
            'report' => ['file', 'mimetypes:application/pdf' ,'required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
