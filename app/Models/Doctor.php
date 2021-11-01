<?php

namespace App\Models;

use App\Filters\DoctorsFilters;
use App\Filters\PaymentLinkFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->where('type', 'doctor');
        });
    }

    public function details(): HasOne
    {
        return $this->hasOne(DoctorDetails::class);
    }

    public function times(): HasMany
    {
        return $this->hasMany(DoctorTimes::class);
    }

    public function scopeFilter($q, DoctorsFilters $filters)
    {
        return $q->where(function ($q) use ($filters) {
            return $filters->apply($q);
        });
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(VisitReview::class, Visit::class);
    }
}
