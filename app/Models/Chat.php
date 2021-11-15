<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope('myChat', function (Builder $builder) {
            $builder
                ->when(auth()->user(), function ($q) {
                    $q->when(auth()->user()->type != 'admin', function ($query) {
                        $query->where('patient_id', auth()->id())
                            ->orWhere('doctor_id', auth()->id());
                    });
                });
        });
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->orderByDesc('created_at');
    }

    public function unreadMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->where('seen', false);
    }
}
