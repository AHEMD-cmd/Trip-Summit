<?php

namespace App\Models;

use App\Models\Tour;
use App\Models\PackageFaq;
use App\Models\Destination;
use Illuminate\Support\Str;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PackageAmenity;
use App\Models\PackageItinerary;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, FilterTrait;

    protected $guarded = [];

    /**
     * Relationship to Destination.
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Relationship to PackageAmenities.
     */
    public function packageAmenities()
    {
        return $this->hasMany(PackageAmenity::class)->with('amenity');
    }

    /**
     * Relationship to included amenities.
     */
    public function includedAmenities()
    {
        return $this->hasMany(PackageAmenity::class)->where('type', 'Include')->with('amenity');
    }

    /**
     * Relationship to excluded amenities.
     */
    public function excludedAmenities()
    {
        return $this->hasMany(PackageAmenity::class)->where('type', 'Exclude')->with('amenity');
    }

    /**
     * Relationship to PackageItineraries.
     */
    public function packageItineraries()
    {
        return $this->hasMany(PackageItinerary::class);
    }

    /**
     * Relationship to PackagePhotos.
     */
    public function photos()
    {
        return $this->hasMany(PackagePhoto::class);
    }

    /**
     * Relationship to PackageVideos.
     */
    public function videos()
    {
        return $this->hasMany(PackageVideo::class);
    }

    /**
     * Relationship to PackageFaqs.
     */
    public function faqs()
    {
        return $this->hasMany(PackageFaq::class);
    }

    /**
     * Relationship to Tours.
     */
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    /**
     * Relationship to Reviews with user data.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)->with('user');
    }

    /**
     * Relationship to Wishlists.
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Accessor for featured photo URL.
     */
    public function getFeaturedPhotoAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }

    /**
     * Accessor for banner URL.
     */
    public function getBannerAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }

    /**
     * Boot method for model events.
     */
    protected static function booted()
    {
        // Delete associated files when a package is deleted
        static::deleting(function ($package) {
            $featuredPhoto = $package->getRawOriginal('featured_photo');
            if ($featuredPhoto && Storage::disk('public')->exists($featuredPhoto)) {
                Storage::disk('public')->delete($featuredPhoto);
            }

            $banner = $package->getRawOriginal('banner');
            if ($banner && Storage::disk('public')->exists($banner)) {
                Storage::disk('public')->delete($banner);
            }
        });

        // Generate slug when a package is created
        static::created(function ($package) {
            $package->slug = Str::slug($package->name);
            $package->save();
        });
    }
}