<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\HomeItem;

class HomeItemUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Check if there is an existing testimonial background image in the database
        $home_item = HomeItem::first();
        $is_image_required = $home_item && $home_item->testimonial_background ? 'nullable' : 'required';

        return [
            'destination_heading' => 'required',
            'destination_subheading' => 'required',
            'destination_status' => 'required|in:Show,Hide',
            'feature_status' => 'required|in:Show,Hide',
            'package_heading' => 'required',
            'package_subheading' => 'required',
            'package_status' => 'required|in:Show,Hide',
            'testimonial_heading' => 'required',
            'testimonial_subheading' => 'required',
            'testimonial_status' => 'required|in:Show,Hide',
            'testimonial_background' => "$is_image_required|image|mimes:jpeg,jpg,png,gif|max:2048",
            'blog_heading' => 'required',
            'blog_subheading' => 'required',
            'blog_status' => 'required|in:Show,Hide',
        ];
    }
}