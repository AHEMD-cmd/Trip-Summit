<?php

namespace App\Services\Payment;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class PayPalService implements PaymentMethodInterface
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->provider->getAccessToken();
    }

    public function pay(array $data)
    {
        $response = $this->provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $data['total_price']
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    // Set session data
                    Session::put('total_person', $data['total_person']);
                    Session::put('tour_id', $data['tour_id']);
                    Session::put('user_id', $data['user_id']);
                    Session::put('paid_amount', $data['total_price']);
                    // Redirect to PayPal approval URL
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('paypal.cancel');
    }

    public function handleSuccess(array $data)
    {
        $response = $this->provider->capturePaymentOrder($data['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return [
                'status' => 'success',
                'data' => [
                    'paid_amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
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
