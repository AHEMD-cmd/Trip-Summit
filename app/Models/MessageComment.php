<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageComment extends Model
{
    use HasFactory;

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }
}
