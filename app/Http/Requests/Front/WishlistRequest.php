<?php

namespace App\Http\Requests\Front;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only allow authenticated users
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user_id = Auth::guard('web')->user()->id;

        return [
            'package_id' => [
                'required',
                'exists:packages,id',
                Rule::unique('wishlists')->where(function ($query) use ($user_id) {
                    return $query->where('user_id', $user_id);
                }),
            ],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'package_id.unique' => 'This item is already in your wishlist!',
        ];
    }
}