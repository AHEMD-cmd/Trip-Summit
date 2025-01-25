<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Mail\Websitemail;
use App\Models\ContactItem;
use Illuminate\Http\Request;
use App\Jobs\SendContactFormEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Front\ContactFormRequest;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $contactItem = ContactItem::first();
        return view('front.contact', compact('contactItem'));
    }

    public function store(ContactFormRequest $request)
    {
        $admin = Admin::first();
        
        // Prepare email content
        $subject = "Contact Form Message";
        $message = "<b>Name:</b><br>" . $request->name . "<br><br>";
        $message .= "<b>Email:</b><br>" . $request->email . "<br><br>";
        $message .= "<b>Comment:</b><br>" . nl2br($request->comment) . "<br>";
    
        // Dispatch the job to send the email
        SendContactFormEmail::dispatch($admin->email, $subject, $message);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message is submitted successfully. We will contact you soon.');
    }
}
