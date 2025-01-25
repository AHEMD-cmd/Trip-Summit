<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Destination;
use App\Http\Requests\Admin\PackageStoreRequest;
use App\Http\Requests\Admin\PackageUpdateRequest;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }

    public function create()
    {
        $destinations = Destination::orderBy('name', 'asc')->get();
        return view('admin.package.create', compact('destinations'));
    }

    public function store(PackageStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_photo')) {
            $data['featured_photo'] = uploadPhoto($request->file('featured_photo'), 'packages');
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = uploadPhoto($request->file('banner'), 'packages');
        }

        Package::create($data);

        return redirect()->route('packages.index')->with('success', 'Package is Created Successfully');
    }

    public function edit(Package $package)
    {
        $destinations = Destination::orderBy('name')->get();
        return view('admin.package.edit', compact('package', 'destinations'));
    }

    public function update(PackageUpdateRequest $request, Package $package)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_photo')) {
            $data['featured_photo'] = updatePhoto($request->file('featured_photo'), $package, 'packages', 'featured_photo');
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = updatePhoto($request->file('banner'), $package, 'packages', 'banner');
        }

        $package->update($data);

        return redirect()->route('packages.index')->with('success', 'Package is Updated Successfully');
    }

    public function destroy(Package $package)
    {
        if ($package->tours()->exists()) {
            return redirect()->back()->with('error', 'First Delete All Tours of This Package');
        }
        
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package is Deleted Successfully');
    }
}