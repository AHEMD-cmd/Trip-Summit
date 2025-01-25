<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeItem;
use App\Http\Requests\Admin\HomeItemUpdateRequest;

class HomeItemController extends Controller
{
    public function edit()
    {
        $home_item = HomeItem::firstOrCreate([]);
        return view('admin.home_item.edit', compact('home_item'));
    }

    public function update(HomeItemUpdateRequest $request)
    {
        $home_item = HomeItem::firstOrCreate([]);
    
        $data = $request->validated();
    
        if ($request->hasFile('testimonial_background')) {
            $data['testimonial_background'] = updatePhoto($request->testimonial_background, $home_item, 'testimonial_background', 'testimonial_background');
        }
    
        $home_item->update($data);
    
        return redirect()->back()->with('success', 'Home Item Updated Successfully');
    }
}