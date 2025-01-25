<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TermPrivacyItemUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // Ensure the user is authorized to make this request
        return true;
    }

    public function rules()
    {
        return [
            'term' => 'required|string|max:10000', // Add validation rules for the term
            'privacy' => 'required|string|max:10000', // Add validation rules for the privacy
        ];
    }
}