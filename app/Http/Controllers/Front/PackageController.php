<?php

namespace App\Http\Controllers\Front;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Filters\Admin\PackageFilter;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function index(Request $request, PackageFilter $filter)
    {
        $destinations = Destination::orderBy('name', 'asc')->get();

        $packages = Package::filter($filter)->with(['destination', 'packageAmenities', 'packageItineraries', 'tours', 'reviews'])->latest()->paginate(6);

        return view('front.packages', compact('destinations', 'packages'));
    }

    public function show($slug)
    {
        // Fetch the package with all related data using eager loading
        $package = Package::with([
            'destination',
            'includedAmenities',
            'excludedAmenities',
            'packageItineraries',
            'photos',
            'videos',
            'faqs',
            'tours',
            'reviews.user',
        ])->where('slug', $slug)->firstOrFail();
    
        // Pass the data to the view
        return view('front.package', compact('package'));
    }
}
