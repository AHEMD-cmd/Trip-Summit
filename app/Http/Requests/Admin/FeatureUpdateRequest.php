<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeatureUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
            'icon' => ['required', 'max:50'],
            'heading' => ['required', 'max:255'],
            'description' => ['required', 'max:2000'],
        ];
    }
}
