<?php

namespace App\Http\Controllers\Admin\Package;

use App\Models\Package;
use App\Models\PackageFaq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageFaqStoreRequest;
use App\Http\Requests\Admin\PackageFaqUpdateRequest;

class PackageFaqController extends Controller
{
    public function index(Package $package)
    {
        $package->load('faqs');
        return view('admin.package.faqs', compact('package'));
    }

    public function store(PackageFaqStoreRequest $request, Package $package)
    {
        $package->faqs()->create($request->validated());

        return redirect()->back()->with('success', 'FAQ is Inserted Successfully');
    }

    public function destroy(Package $package, PackageFaq $faq)
    {
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ is Deleted Successfully');
    }
}
