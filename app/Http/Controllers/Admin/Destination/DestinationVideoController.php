<?php

namespace App\Http\Controllers\Admin\Destination;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationVideo;
use Illuminate\Http\Request;

class DestinationVideoController extends Controller
{
    public function index(Destination $destination)
    {
        $videos = $destination->videos;
        return view('admin.destination.videos.index', compact('destination', 'videos'));
    }

    public function store(Request $request, Destination $destination)
    {
        $request->validate([
            'video' => ['required', 'string'], 
        ]);

            $destination->videos()->create([
                'video' => $request->video,
            ]);

        return redirect()->route('destinations.videos.index', $destination->id)
            ->with('success', 'Videos added successfully.');
    }

    public function destroy(Destination $destination, DestinationVideo $video)
    {
        $video->delete();

        return redirect()->route('destinations.videos.index', $destination->id)
            ->with('success', 'Video deleted successfully.');
    }
}