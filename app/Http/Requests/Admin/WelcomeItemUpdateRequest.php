<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WelcomeItemUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        $rules = [
            'heading' => ['required'],
            'description' => ['required'],
            'video' => ['required'],
            'button_text' => ['nullable', 'string'],
            'button_link' => ['nullable', 'string'],
            'status' => 'required|in:Show,Hide',
        ];

        // Add photo validation if a photo is uploaded
        if ($this->hasFile('photo')) {
            $rules['photo'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        return $rules;
    }
}