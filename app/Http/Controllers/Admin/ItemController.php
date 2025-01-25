<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutItemUpdateRequest;

class ItemController extends Controller
{
    public function edit()
    {
        $aboutItem = AboutItem::firstOrCreate([]);
        return view('admin.about_item.edit', compact('aboutItem'));
    }

    public function update(AboutItemUpdateRequest $request)
    {
        $aboutItem = AboutItem::firstOrCreate([]);

        $aboutItem->update($request->validated());

        return back()->with('success', 'About Item Updated Successfully');
    }
}
