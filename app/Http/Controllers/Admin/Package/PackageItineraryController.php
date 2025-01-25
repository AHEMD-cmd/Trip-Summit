<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageItinerary;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackageItineraryStoreRequest;

class PackageItineraryController extends Controller
{
    public function index(Package $package)
    {
        $packageItineraries = PackageItinerary::where('package_id', $package->id)->get();
        return view('admin.package.itineraries', compact('package', 'packageItineraries'));
    }

    public function store(PackageItineraryStoreRequest $request, Package $package)
    {
        $package->packageItineraries()->create($request->validated());
        return redirect()->back()->with('success', 'Item is Inserted Successfully');
    }

    public function destroy(Package $package, PackageItinerary $itinerary)
    {
        $itinerary->delete();
        return redirect()->back()->with('success', 'Item is Deleted Successfully');
    }
}