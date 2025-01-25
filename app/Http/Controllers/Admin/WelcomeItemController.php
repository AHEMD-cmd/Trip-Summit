<?php

namespace App\Http\Controllers\Admin;

use App\Models\WelcomeItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WelcomeItemUpdateRequest;

class WelcomeItemController extends Controller
{
    public function edit()
    {
        $welcomeItem = WelcomeItem::first();
        return view('admin.welcome.edit',compact('welcomeItem'));
    }
    
    public function update(WelcomeItemUpdateRequest $request)
    {
        $welcomeItem = WelcomeItem::first();
    
        $data = $request->validated();
    
        if ($request->hasFile('photo')) {
            $data['photo'] = updatePhoto($request->photo, $welcomeItem, 'welcome_items');
        }
    
        $welcomeItem->update($data);
    
        return redirect()->back()->with('success', 'Welcome Item Updated Successfully');
    }
}
