<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $touches = ['chat'];
    protected $guarded = ['id'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
