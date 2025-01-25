<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactItemUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // Ensure the user is authorized to make this request
        return true;
    }

    public function rules()
    {
        return [
            'map_code' => 'required|string', // Add any other validation rules as needed
        ];
    }
}