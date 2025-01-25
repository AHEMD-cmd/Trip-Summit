<?php

namespace App\Http\Controllers\Admin\Destination;

use App\Models\Destination;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestinationStoreRequest;
use App\Http\Requests\Admin\DestinationUpdateRequest;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::get();
        return view('admin.destination.index',compact('destinations'));
    }

    public function create()
    {
        return view('admin.destination.create');
    }

    public function store(DestinationStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_photo')) {
            $data['featured_photo'] = uploadPhoto($request->file('featured_photo'), 'destinations');
        }

        Destination::create($data);

        return redirect()->route('destinations.index')->with('success','Destination is Created Successfully');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destination.edit',compact('destination'));
    }
    
    public function update(DestinationUpdateRequest $request, Destination $destination)
    {   
        $data = $request->validated();

        if ($request->hasFile('featured_photo')) {
            $data['featured_photo'] = updatePhoto($request->file('featured_photo'), $destination, 'destinations');
        }

        $destination->update($data);

        return redirect()->route('destinations.index')->with('success','Destination is Updated Successfully');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('destinations.index')->with('success','Destination is Deleted Successfully');
    }
}
