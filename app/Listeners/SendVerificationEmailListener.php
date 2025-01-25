<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendVerificationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
        $subject = 'User Account Verification';
        SendVerificationEmail::dispatch($event->user->email, $subject, $event->verification_link)->onQueue('emails');
    }
}
