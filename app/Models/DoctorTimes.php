<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorTimes extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date'];
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
}
