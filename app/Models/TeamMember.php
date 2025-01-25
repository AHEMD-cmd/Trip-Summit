<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class TeamMember extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::deleting(function ($team_member) {
            if ($team_member->photo && Storage::disk('public')->exists($team_member->photo)) {
                Storage::disk('public')->delete($team_member->photo);
            }
        });

        static::created(function ($team_member) {
            $team_member->slug = Str::slug($team_member->name . '-' . $team_member->id);
            $team_member->save();
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
