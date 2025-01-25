<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $verification_link;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param string $verification_link
     */
    public function __construct(User $user, string $verification_link)
    {
        $this->user = $user;
        $this->verification_link = $verification_link;
    }
}