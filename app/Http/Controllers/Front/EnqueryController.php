<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\Package;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Jobs\SendEnqueryEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Front\EnqueryFormRequest;

class EnqueryController extends Controller
{
    public function __invoke(EnqueryFormRequest $request, Package $package)
    {
        $admin = Admin::first();

        // Prepare email content
        $subject = "Enquery about: " . $package->name;
        $message = "<b>Name:</b><br>" . $request->name . "<br><br>";
        $message .= "<b>Email:</b><br>" . $request->email . "<br><br>";
        $message .= "<b>Phone:</b><br>" . $request->phone . "<br><br>";
        $message .= "<b>Message:</b><br>" . nl2br($request->message) . "<br>";

        // Dispatch the job to send the email
        SendEnqueryEmail::dispatch($admin->email, $subject, $message);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your enquery is submitted successfully. We will contact you soon.');
    }
}
