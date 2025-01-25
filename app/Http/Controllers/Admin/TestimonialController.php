<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialStoreRequest;
use App\Http\Requests\Admin\TestimonialUpdateRequest;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(TestimonialStoreRequest $request)
    {
        $data = $request->validated();

        $data['photo'] = uploadPhoto($request->photo, 'testimonials');

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial Created Successfully');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = updatePhoto($request->photo, $testimonial, 'testimonials');
        }
        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial Updated Successfully');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial Deleted Successfully');
    }
}