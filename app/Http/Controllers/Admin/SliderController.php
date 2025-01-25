<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderStoreRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderStoreRequest $request)
    {
        $data = $request->validated();

        $data['photo'] = uploadPhoto($request->photo, 'sliders');

        $slider = Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slider Created Successfully');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = updatePhoto($request->photo, $slider, 'slider_images');
        }
        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider Updated Successfully');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slider Deleted Successfully');
    }
}
