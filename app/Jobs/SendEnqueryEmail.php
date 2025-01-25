<?php

namespace App\Jobs;

use App\Mail\Websitemail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class SendEnqueryEmail implements ShouldQueue
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

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        // Log the error or notify an admin
        Log::error('Failed to send enquery email: ' . $exception->getMessage());
    }
}