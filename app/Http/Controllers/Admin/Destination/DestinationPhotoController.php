<?php

namespace App\Http\Controllers\Admin\Destination;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationPhotoController extends Controller
{
    public function index(Destination $destination)
    {
        $photos = $destination->photos;
        return view('admin.destination.photos.index', compact('destination', 'photos'));
    }

    public function store(Request $request, Destination $destination)
    {
        // dd($request->all());
        $request->validate([
            'photos' => ['required', 'array'], 
            'photos.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], 
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photo = uploadPhoto($photo, 'destinations');

                $destination->photos()->create([
                    'photo' => $photo,
                ]);
            }
        }

        return redirect()->route('destinations.photos.index', $destination->id)
            ->with('success', 'Photos uploaded successfully.');
    }

    public function destroy(Destination $destination, DestinationPhoto $photo)
    {

        $photo->delete();

        return redirect()->route('destinations.photos.index', $destination->id)
            ->with('success', 'Photo deleted successfully.');
    }
}
