<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
 
    protected $guarded = [];

    protected static function booted()
    {
        static::deleting(function ($slider) {
            // Get the original photo value, not the accessor-modified one
            $photo = $slider->getRawOriginal('photo');
            if ($photo && Storage::disk('public')->exists($photo)) {
                Storage::disk('public')->delete($photo);
            }
        });
    }

    public function getPhotoAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return null;
    }
}
