<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadPhoto')) {
    function uploadPhoto(UploadedFile $image, string $path = 'images'): string
    {
        return $image->store($path, 'public');
    }
}

if (!function_exists('updatePhoto')) {
    function updatePhoto(UploadedFile $image,  $model,  string $path = 'images', $photo = 'photo'): string
    {
        $photo = $model->getRawOriginal($photo);

        if ($photo && Storage::disk('public')->exists($photo)) {
            Storage::disk('public')->delete($photo);
        }
        return $image->store($path, 'public');
    }
}
