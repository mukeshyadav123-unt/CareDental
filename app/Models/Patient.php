<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->where('type', 'patient');
        });
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class)->orderByDesc('updated_at');
    }

    public function doctors(): HasManyThrough
    {
        return $this->hasManyThrough(Doctor::class, Visit::class, 'patient_id', 'id', 'id', 'doctor_id');
    }

    public function contactInformation(): HasOne
    {
        return $this->hasOne(PatientContactInformation::class);
    }

    public function details(): HasOne
    {
        return $this->hasOne(PatientDetails::class);
    }
}
