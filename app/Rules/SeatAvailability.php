<?php

namespace App\Rules;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Contracts\Validation\Rule;

class SeatAvailability implements Rule
{
    protected $tourId;
    protected $totalPerson;
    protected $message;

    public function __construct($tourId, $totalPerson)
    {
        $this->tourId = $tourId;
        $this->totalPerson = $totalPerson;
    }

    public function passes($attribute, $value)
    {
        $tour = Tour::find($this->tourId);

        // If total_seat is -1, seats are unlimited
        if ($tour->total_seat == '-1') {
            return true;
        }

        // Calculate remaining seats
        $totalBookedSeats = Booking::where('tour_id', $this->tourId)->sum('total_person');
        $remainingSeats = $tour->total_seat - $totalBookedSeats;

        // Check if requested seats are available
        if ($this->totalPerson > $remainingSeats) {
            $this->message = 'Sorry! Only ' . $remainingSeats . ' seats are available for this tour!';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}