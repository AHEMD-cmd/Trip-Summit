<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactItem;
use App\Http\Requests\Admin\ContactItemUpdateRequest; // Create a custom request for validation

class ContactItemController extends Controller
{
    public function edit()
    {
        $contactItem = ContactItem::firstOrCreate([]);
        return view('admin.contact_item.edit', compact('contactItem'));
    }

    public function update(ContactItemUpdateRequest $request, ContactItem $contactItem)
    {
        $contactItem->update($request->validated());

        return back()->with('success', 'Contact Item Updated Successfully');
    }
}