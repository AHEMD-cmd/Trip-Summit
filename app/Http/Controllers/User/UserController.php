<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Admin;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Message;
use App\Models\Wishlist;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Models\MessageComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        $total_completed_orders = Booking::where('user_id',Auth::guard('web')->user()->id)->where('payment_status','Completed')->count();
        $total_pending_orders = Booking::where('user_id',Auth::guard('web')->user()->id)->where('payment_status','Pending')->count();
        return view('user.dashboard', compact('total_completed_orders', 'total_pending_orders'));
    }



}
