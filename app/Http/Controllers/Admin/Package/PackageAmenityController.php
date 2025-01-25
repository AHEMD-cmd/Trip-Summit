<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Amenity;
use App\Models\PackageAmenity;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackageAmenityStoreRequest;

class PackageAmenityController extends Controller
{
    public function index(Package $package)
    {
        $packageAmenitiesInclude = $package->packageAmenities()->where('type', 'Include')->get();

        $packageAmenitiesExclude = $package->packageAmenities()->where('type', 'Exclude')->get();

        $amenities = Amenity::orderBy('name', 'asc')->get();

        return view('admin.package.amenities', compact(
            'package',
            'packageAmenitiesInclude',
            'packageAmenitiesExclude',
            'amenities'
        ));
    }

    public function store(PackageAmenityStoreRequest $request, Package $package)
    {
        $package->packageAmenities()->create($request->validated());

        return redirect()->back()->with('success', 'Item is Inserted Successfully');
    }

    public function destroy(Package $package, PackageAmenity $amenity)
    {
        $amenity->delete();
        return redirect()->back()->with('success', 'Item is Deleted Successfully');
    }
}
