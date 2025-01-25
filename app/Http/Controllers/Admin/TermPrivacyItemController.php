<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermPrivacyItem;
use App\Http\Requests\Admin\TermPrivacyItemUpdateRequest; // Create a custom request for validation

class TermPrivacyItemController extends Controller
{
    public function edit(TermPrivacyItem $termPrivacyItem)
    {
        // Fetch the term and privacy item or create a new one if it doesn't exist
        $termPrivacyItem = TermPrivacyItem::firstOrCreate([]);
        return view('admin.term_privacy_item.edit', compact('termPrivacyItem'));
    }

    public function update(TermPrivacyItemUpdateRequest $request)
    {
        $termPrivacyItem = TermPrivacyItem::firstOrCreate([]);
        // Update the term and privacy item with validated data
        $termPrivacyItem->update($request->validated());

        // Redirect back with a success message
        return back()->with('success', 'Term & Privacy Item Updated Successfully');
    }
}