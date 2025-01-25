<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DestinationVideo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}