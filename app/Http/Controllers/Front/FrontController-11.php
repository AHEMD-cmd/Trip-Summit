<?php

namespace App\Http\Controllers\Front;


use App\Models\Tour;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontController extends Controller
{


    public function payment(Request $request)
    {
        //dd($request->all());

        // Check the tour selection
        if (!$request->tour_id) {
            return redirect()->back()->with('error', 'Please select a tour first!');
        }

        // Check the seat availability
        $tour_data = Tour::where('id', $request->tour_id)->first();
        $total_allowed_seats = $tour_data->total_seat;

        if ($total_allowed_seats != '-1') {
            $total_booked_seats = 0;
            $all_data = Booking::where('tour_id', $request->tour_id)->get();
            foreach ($all_data as $data) {
                $total_booked_seats += $data->total_person;
            }

            $remaining_seats = $total_allowed_seats - $total_booked_seats;

            if ($total_booked_seats + $request->total_person > $total_allowed_seats) {
                return redirect()->back()->with('error', 'Sorry! Only ' . $remaining_seats . ' seats are available for this tour!');
            }
        }


        $user_id = Auth::guard('web')->user()->id;
        $package = Package::where('id', $request->package_id)->first();
        $total_price = $package->price * $request->total_person;

        if ($request->payment_method == 'PayPal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total_price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        session()->put('total_person', $request->total_person);
                        session()->put('tour_id', $request->tour_id);
                        session()->put('package_id', $request->package_id);
                        session()->put('user_id', $user_id);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal.cancel');
            }
        } elseif ($request->payment_method == 'Stripe') {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $package->name,
                            ],
                            'unit_amount' => $total_price * 100,
                        ],
                        'quantity' => $request->total_person,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);
            //dd($response);
            if (isset($response->id) && $response->id != '') {
                session()->put('total_person', $request->total_person);
                session()->put('tour_id', $request->tour_id);
                session()->put('package_id', $request->package_id);
                session()->put('user_id', $user_id);
                session()->put('paid_amount', $total_price);
                return redirect($response->url);
            } else {
                return redirect()->route('stripe_cancel');
            }
        } elseif ($request->payment_method == 'Cash') {
            $obj = new Booking;
            $obj->tour_id = $request->tour_id;
            $obj->user_id = Auth::guard('web')->user()->id;
            $obj->total_person = $request->total_person;
            $obj->paid_amount = $request->ticket_price;
            $obj->payment_method = "Cash";
            $obj->payment_status = "Pending";
            $obj->invoice_no = time();
            $obj->save();

            return redirect()->back()->with('success', 'Payment is pending and will be successful after admin approval!');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // Insert data into database
            $obj = new Booking;
            $obj->tour_id = session()->get('tour_id');
            $obj->user_id = session()->get('user_id');
            $obj->total_person = session()->get('total_person');
            $obj->payment_method = "PayPal";
            $obj->payment_status = 'Completed';
            $obj->invoice_no = time();
            $obj->save();

            return redirect()->back()->with('success', 'Payment is successful!');

            unset($_SESSION['tour_id']);
            unset($_SESSION['package_id']);
            unset($_SESSION['user_id']);
            unset($_SESSION['total_person']);
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function paypalCancel()
    {
        return redirect()->back()->with('error', 'Payment is cancelled!');
    }


    public function stripeSuccess(Request $request)
    {
        if (isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //dd($response);

            $obj = new Booking;
            $obj->tour_id = session()->get('tour_id');
            $obj->user_id = session()->get('user_id');
            $obj->total_person = session()->get('total_person');
            $obj->paid_amount = session()->get('paid_amount');
            $obj->payment_method = "Stripe";
            $obj->payment_status = "Completed";
            $obj->invoice_no = time();
            $obj->save();

            return redirect()->back()->with('success', 'Payment is successful!');

            unset($_SESSION['tour_id']);
            unset($_SESSION['package_id']);
            unset($_SESSION['user_id']);
            unset($_SESSION['total_person']);
            unset($_SESSION['paid_amount']);
        } else {
            return redirect()->route('stripe_cancel');
        }
    }

    public function stripe_cancel()
    {
        return redirect()->back()->with('error', 'Payment is cancelled!');
    }
}
