<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageVideo;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackageVideoStoreRequest;

class PackageVideoController extends Controller
{
    public function index(Package $package)
    {
        $package->load('videos');
        return view('admin.package.videos', compact('package'));
    }

    public function store(PackageVideoStoreRequest $request, Package $package)
    {
        $package->videos()->create($request->validated());

        return redirect()->back()->with('success', 'Video is Inserted Successfully');
    }

    public function destroy(Package $package, PackageVideo $video)
    {
        $video->delete();
        return redirect()->back()->with('success', 'Video is Deleted Successfully');
    }
}