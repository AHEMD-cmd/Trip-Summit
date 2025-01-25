<?php

namespace App\Http\Controllers\Front;

use App\Models\Tour;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Front\PaymentRequest;
use App\Services\Payment\PaymentMethodInterface;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentMethodInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function payment(PaymentRequest $request)
    {
        // Store payment method in session
        Session::put('payment_method', $request->payment_method);

        // Prepare payment data
        $package = Package::findOrFail($request->package_id);
        $total_price = $package->price * $request->total_person;

        $paymentData = [
            'tour_id' => $request->tour_id,
            'user_id' => Auth::guard('web')->user()->id,
            'total_person' => $request->total_person,
            'total_price' => $total_price,
            'package_name' => $package->name,
        ];

        // Process payment using the resolved payment service
        return $this->paymentService->pay($paymentData);
    }

    public function paypalSuccess(Request $request)
    {
        $result = $this->paymentService->handleSuccess(['token' => $request->token]);

        if ($result['status'] === 'success') {
            $this->saveBooking([
                'tour_id' => Session::get('tour_id'),
                'user_id' => Session::get('user_id'),
                'total_person' => Session::get('total_person'),
                'paid_amount' => $result['data']['paid_amount'],
                'payment_method' => 'PayPal',
                'payment_status' => 'Completed',
            ]);

            // Clear session data
            Session::forget(['tour_id', 'user_id', 'total_person', 'paid_amount', 'payment_method']);

            return redirect()->back()->with('success', 'Payment is successful!');
        }


        return redirect()->route('paypal.cancel');
    }

    public function stripeSuccess(Request $request)
    {
        $result = $this->paymentService->handleSuccess(['session_id' => $request->session_id]);

        if ($result['status'] === 'success') {
            $this->saveBooking([
                'tour_id' => Session::get('tour_id'),
                'user_id' => Session::get('user_id'),
                'total_person' => Session::get('total_person'),
                'paid_amount' => Session::get('paid_amount'),
                'payment_method' => 'Stripe',
                'payment_status' => 'Completed',
            ]);

            // Clear session data
            Session::forget(['tour_id', 'user_id', 'total_person', 'paid_amount', 'payment_method']);

            return redirect()->back()->with('success', 'Payment is successful!');
        }

        return redirect()->route('stripe_cancel');
    }

    public function paypalCancel()
    {
        $result = $this->paymentService->handleCancel();
        return redirect()->back()->with('error', $result['message']);
    }

    public function stripeCancel()
    {
        $result = $this->paymentService->handleCancel();
        return redirect()->back()->with('error', $result['message']);
    }

    protected function saveBooking(array $data)
    {
        Booking::create([
            'tour_id' => $data['tour_id'],
            'user_id' => $data['user_id'],
            'total_person' => $data['total_person'],
            'paid_amount' => $data['paid_amount'],
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_status'],
            'invoice_no' => time(),
        ]);
    }
}
