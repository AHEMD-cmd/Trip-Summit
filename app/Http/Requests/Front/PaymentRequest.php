<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SeatAvailability;

class PaymentRequest extends FormRequest
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
            'tour_id' => 'required|exists:tours,id',
            'package_id' => 'required|exists:packages,id',
            'total_person' => 'required|integer|min:1',
            'payment_method' => 'required|in:PayPal,Stripe,Cash',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->sometimes('total_person', new SeatAvailability($this->tour_id, $this->total_person), function ($input) {
            // Apply the rule only if tour_id and total_person are provided
            return !empty($input->tour_id) && !empty($input->total_person);
        });
    }
}