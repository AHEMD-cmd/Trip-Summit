<?php

namespace App\Services\Payment;

use Stripe\StripeClient;
use Illuminate\Support\Facades\Session;

class StripeService implements PaymentMethodInterface
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.stripe_sk'));
    }

    public function pay(array $data)
    {
        $response = $this->stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $data['package_name'],
                        ],
                        'unit_amount' => $data['total_price'] * 100,
                    ],
                    'quantity' => $data['total_person'],
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        if (isset($response->id) && $response->id != '') {
            Session::put('total_person', $data['total_person']);
            Session::put('tour_id', $data['tour_id']);
            Session::put('user_id', $data['user_id']);
            Session::put('paid_amount', $data['total_price']);
            return redirect($response->url);
        }

        return redirect()->route('stripe_cancel');
    }

    public function handleSuccess(array $data)
    {
        if (isset($data['session_id'])) {
            $response = $this->stripe->checkout->sessions->retrieve($data['session_id']);

            return [
                'status' => 'success',
                'data' => [
                    'paid_amount' => Session::get('paid_amount'),
                ]
            ];
        }

        return ['status' => 'error'];
    }

    public function handleCancel()
    {
        return ['status' => 'error', 'message' => 'Payment is cancelled!'];
    }
}