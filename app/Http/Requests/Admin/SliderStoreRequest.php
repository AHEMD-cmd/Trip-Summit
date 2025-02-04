<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'heading' => ['required'],
            'text' => ['required'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'button_text' => ['nullable', 'string'],
            'button_link' => ['nullable', 'string'],
        ];
    }
}