<?php

namespace App\Http\Controllers\User;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __invoke()
    {
        $bookings = Booking::with(['tour', 'package'])->where('user_id', Auth::guard('web')->user()->id)->get();
        return view('user.booking', compact('bookings'));
    }
}
