<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorTimes extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = ['is_booked' => 'boolean'];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function setToAttribute($to)
    {
        $this->attributes['to'] = optional($to)->toTimeString() ?? $to;
    }

    public function setFromAttribute($from)
    {
        $this->attributes['from'] = optional($from)->toTimeString() ?? $from;
    }

    public function visit(): HasOne
    {
        return $this->hasOne(Visit::class);
    }
}
