<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,gif', 'max:2024'],
            'password' => ['nullable', 'confirmed', 'string', 'max:255'],
        ];

        return $rules;
    }

    public function validatedWithPasswordHandling()
    {
        $validatedData = $this->validated();

        // Exclude password if it's empty
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        }

        return $validatedData;
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        return $validated;
    }
}
