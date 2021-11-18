<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResetPassword extends Model
{
    use HasFactory;

    public $timestamps = ['used_at', 'expire_at'];
    protected $dates = ['used_at', 'expire_at'];
    protected $guarded = [];
}
