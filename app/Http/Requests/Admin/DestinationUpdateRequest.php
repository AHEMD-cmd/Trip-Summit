<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DestinationUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:destinations,name,' . $this->route('destination')->id],
            'description' => ['required', 'string'],
            'featured_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'country' => ['required', 'string', 'max:255'],
            'language' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'timezone' => ['required', 'string', 'max:255'],
            'visa_requirement' => ['required', 'string'],
            'activity' => ['required', 'string'],
            'best_time' => ['required', 'string'],
            'health_safety' => ['required', 'string'],
            'map' => ['required', 'string'],
        ];
    }
}
