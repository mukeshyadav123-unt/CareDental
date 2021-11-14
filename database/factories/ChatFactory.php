<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'doctor_id' => 3,
            'patient_id' => 2,
        ];
    }
}
