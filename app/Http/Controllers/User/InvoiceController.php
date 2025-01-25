<?php

namespace App\Http\Controllers\User;

use App\Models\Admin;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function __invoke($invoice)
    {
        $admin = Admin::where('id',1)->first();
        $booking = Booking::with(['tour.package'])->where('invoice_no',$invoice)->first();
        return view('user.invoice', compact('booking', 'admin'));
    }
}
