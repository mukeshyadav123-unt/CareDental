<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
