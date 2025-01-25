<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use Illuminate\Foundation\Bus\Dispatchable;


class SendContactFormEmail implements ShouldQueue
{
    use Queueable, SerializesModels, Dispatchable;

    protected $adminEmail;
    protected $subject;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($adminEmail, $subject, $message)
    {
        $this->adminEmail = $adminEmail;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send the email
        Mail::to($this->adminEmail)->send(new Websitemail($this->subject, $this->message));
    }
}