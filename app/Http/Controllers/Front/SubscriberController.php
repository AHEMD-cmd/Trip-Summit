<?php

namespace App\Http\Controllers\Front;

use App\Mail\Websitemail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $token = hash('sha256', time());

        $obj = new Subscriber;
        $obj->email = $request->email;
        $obj->token = $token;
        $obj->status = 'Pending';
        $obj->save();

        $verification_link = route('subscriber.verify', ['email' => $request->email, 'token' => $token]);
        $subject = 'Subscriber Verification';
        $message = 'Please click the following link to verify your email address as subscriber:<br><a href="' . $verification_link . '">Verify Email</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'You are subscribed successfully. Please check your email to confirm the verification link.');
    }

    public function subscriberVerify($email, $token)
    {
        $subscriber = Subscriber::where('token', $token)->where('email', $email)->first();
        if (!$subscriber) {
            return redirect()->route('home');
        }
        $subscriber->token = '';
        $subscriber->status = 'Active';
        $subscriber->update();

        return redirect()->back()->with('success', 'Your subscribtion is successful.');
    }
}
