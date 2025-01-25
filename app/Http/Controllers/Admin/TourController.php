<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Package;
use App\Models\Booking;
use App\Http\Requests\Admin\TourStoreRequest;
use App\Http\Requests\Admin\TourUpdateRequest;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('package')->get();
        return view('admin.tour.index', compact('tours'));
    }

    public function create()
    {
        $packages = Package::orderBy('name', 'asc')->get();
        return view('admin.tour.create', compact('packages'));
    }

    public function store(TourStoreRequest $request)
    {
        Tour::create($request->validated());

        return redirect()->route('tours.index')->with('success', 'Tour is Created Successfully');
    }

    public function edit(Tour $tour)
    {
        $packages = Package::orderBy('name', 'asc')->get();
        return view('admin.tour.edit', compact('tour', 'packages'));
    }

    public function update(TourUpdateRequest $request, Tour $tour)
    {
        $tour->update($request->validated());

        return redirect()->route('tours.index')->with('success', 'Tour is Updated Successfully');
    }

    public function destroy(Tour $tour)
    {
        if ($tour->bookings->count() > 0) {
            return redirect()->back()->with('error', 'This Tour has Bookings. So, it can not be deleted');
        }

        $tour->delete();
        return redirect()->route('tours.index')->with('success', 'Tour is Deleted Successfully');
    }
}
