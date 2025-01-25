<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\Admin\SettingUpdateRequest;
use Illuminate\Http\UploadedFile;

class SettingController extends Controller
{
    public function edit()
    {
        // Fetch the first setting or create a new one if it doesn't exist
        $setting = Setting::firstOrCreate([]);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(SettingUpdateRequest $request)
    {
        $data = $request->validated();
        
        $setting = Setting::firstOrCreate([]);
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = updatePhoto($request->file('logo'), $setting, 'images', 'logo');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $data['favicon'] = updatePhoto($request->file('favicon'), $setting, 'images', 'favicon');
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $data['banner'] = updatePhoto($request->file('banner'), $setting, 'images', 'banner');
        }

        // Update other fields
        $setting->update($data);

        return redirect()->back()->with('success', 'Setting Updated Successfully');
    }
}