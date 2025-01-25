<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCounterItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'item1_number' => 'required',
            'item1_text' => 'required',
            'item2_number' => 'required',
            'item2_text' => 'required',
            'item3_number' => 'required',
            'item3_text' => 'required',
            'item4_number' => 'required',
            'item4_text' => 'required',
            'status' => 'in:Show,Hide', 
        ];
    }
}
