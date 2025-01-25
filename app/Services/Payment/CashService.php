<?php

namespace App\Services\Payment;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CashService implements PaymentMethodInterface
{
    public function pay(array $data)
    {
        // Save the booking details directly for cash payments
        Booking::create([
            'tour_id' => $data['tour_id'],
            'user_id' => $data['user_id'],
            'total_person' => $data['total_person'],
            'paid_amount' => $data['total_price'],
            'payment_method' => 'Cash',
            'payment_status' => 'Pending',
            'invoice_no' => time(),
        ]);

        // Redirect the user back with a success message
        return Redirect::back()->with('success', 'Payment is pending and will be successful after admin approval!');
    }

    public function handleSuccess(array $data)
    {
        // No action needed for cash payments
        return Redirect::back()->with('success', 'Payment is successful!');
    }

    public function handleCancel()
    {
        return Redirect::back()->with('error', 'Payment is cancelled!');
    }
}