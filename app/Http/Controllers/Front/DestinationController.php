<?php

namespace App\Http\Controllers\Front;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('id', 'asc')->paginate(20);
        return view('front.destinations', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::with('photos', 'videos')->where('slug', $slug)->first();
        $destination->view_count = $destination->view_count + 1;
        $destination->update();

        $packages = Package::with(['destination', 'packageAmenities', 'packageItineraries', 'tours', 'reviews'])->orderBy('id', 'desc')->where('destination_id', $destination->id)->get()->take(3);

        return view('front.destination', compact('destination', 'packages'));
    }
}
