<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use Illuminate\Foundation\Bus\Dispatchable;

class SendVerificationEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    protected $email;
    protected $subject;
    protected $verificationLink;

    public function __construct($email, $subject, $verificationLink)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->verificationLink = $verificationLink;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new Websitemail($this->subject, $this->verificationLink));
    }
}