<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackagePhoto;
use App\Http\Requests\Admin\PackagePhotoStoreRequest;

class PackagePhotoController extends Controller
{
    public function index(Package $package)
    {
        $packagePhotos = $package->photos;
        return view('admin.package.photos', compact('package', 'packagePhotos'));
    }

    public function store(PackagePhotoStoreRequest $request, Package $package)
    {
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photo = uploadPhoto($photo, 'packages');
                $package->photos()->create([
                    'photo' => $photo,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Photo is Inserted Successfully');
    }

    public function destroy(Package $package, PackagePhoto $photo)
    {
        $photo->delete();
        return redirect()->back()->with('success', 'Photo is Deleted Successfully');
    }
}
