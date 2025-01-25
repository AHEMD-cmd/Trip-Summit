<?php

namespace App\Http\Requests\Admin;

use App\Models\PackageAmenity;
use Illuminate\Foundation\Http\FormRequest;

class PackageAmenityStoreRequest extends FormRequest
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
            'amenity_id' => [
                'required',
                'exists:amenities,id',
                function ($attribute, $value, $fail) {
                    $packageId = $this->route('package')->id; // Get the package ID from the route
                    $exists = PackageAmenity::where('package_id', $packageId)
                        ->where('amenity_id', $value)
                        ->exists();

                    if ($exists) {
                        $fail('This amenity is already added to the package.');
                    }
                },
            ],
            'type' => 'required|in:Include,Exclude',
        ];
    }
}
