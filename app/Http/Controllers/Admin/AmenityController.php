<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\PackageAmenity;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AmenityStoreRequest;
use App\Http\Requests\Admin\AmenityUpdateRequest;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::all();
        return view('admin.amenity.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenity.create');
    }

    public function store(AmenityStoreRequest $request)
    {
        Amenity::create([
            'name' => $request->name,
        ]);

        return redirect()->route('amenities.index')->with('success', 'Amenity is Created Successfully');
    }

    public function edit(Amenity $amenity)
    {
        return view('admin.amenity.edit', compact('amenity'));
    }

    public function update(AmenityUpdateRequest $request, Amenity $amenity)
    {
        $amenity->update([
            'name' => $request->name,
        ]);

        return redirect()->route('amenities.index')->with('success', 'Amenity is Updated Successfully');
    }

    public function destroy(Amenity $amenity)
    {
        $total = PackageAmenity::where('amenity_id', $amenity->id)->count();
        if ($total > 0) {
            return redirect()->back()->with('error', 'Amenity is Assigned to Package(s), So it can not be deleted');
        }

        $amenity->delete();
        return redirect()->route('amenities.index')->with('success', 'Amenity is Deleted Successfully');
    }
}