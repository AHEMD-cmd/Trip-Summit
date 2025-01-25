<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Support\Str;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photos()
    {
        return $this->hasMany(DestinationPhoto::class);
    }

    public function videos()
    {
        return $this->hasMany(DestinationVideo::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    protected static function booted()
    {
        static::deleting(function ($destination) {
            // Delete the featured photo
            $featuredPhoto = $destination->getRawOriginal('featured_photo');
            if ($featuredPhoto && Storage::disk('public')->exists($featuredPhoto)) {
                Storage::disk('public')->delete($featuredPhoto);
            }

            // Delete all related photos
            foreach ($destination->photos as $photo) {
                $photo = $photo->getRawOriginal('photo');
                if ($photo && Storage::disk('public')->exists($photo)) {
                    Storage::disk('public')->delete($photo);
                }
                $photo->delete(); 
            }

            // Delete all related videos
            foreach ($destination->videos as $video) {
                if ($video->video && Storage::disk('public')->exists($video->video)) {
                    Storage::disk('public')->delete($video->video);
                }
                $video->delete(); 
            }
        });

        static::created(function ($destination) {
            $destination->slug = Str::slug($destination->name);
            $destination->save();
        });
    }

    public function getFeaturedPhotoAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return null;
    }
}