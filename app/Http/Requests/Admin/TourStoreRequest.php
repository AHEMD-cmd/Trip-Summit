<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TourStoreRequest extends FormRequest
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
            'package_id' => 'required|exists:packages,id',
            'tour_start_date' => 'required|date',
            'tour_end_date' => 'required|date|after_or_equal:tour_start_date',
            'booking_end_date' => 'required|date|before_or_equal:tour_start_date',
            'total_seat' => 'required|integer|min:1',
        ];
    }
}
