<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'users';

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
}
