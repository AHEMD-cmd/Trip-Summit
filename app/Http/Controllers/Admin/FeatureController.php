<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureStoreRequest;
use App\Http\Requests\Admin\FeatureUpdateRequest;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::get();
        return view('admin.feature.index', compact('features'));
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function store(FeatureStoreRequest $request)
    {
        Feature::create($request->validated());

        return redirect()->route('features.index')->with('success', 'Feature Created Successfully');
    }

    public function edit(Feature $feature)
    {
        return view('admin.feature.edit', compact('feature'));
    }


    public function update(FeatureUpdateRequest $request, Feature $feature)
    {
        // Update feature using mass assignment
        $feature->update($request->validated());

        return redirect()->route('features.index')->with('success', 'Feature Updated Successfully');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('features.index')->with('success', 'Feature is Deleted Successfully');
    }
}
