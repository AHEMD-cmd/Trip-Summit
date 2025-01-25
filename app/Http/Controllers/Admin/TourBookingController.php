<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Tour;
use App\Http\Controllers\Controller;

class TourBookingController extends Controller
{
    public function index(Tour $tour)
    {
        $tour->load('bookings.user');
        return view('admin.tour.booking', compact('tour'));
    }


    public function show(Tour $tour, Booking $booking)
    {
        $booking->load('user', 'tour.package');
        return view('admin.tour.invoice', compact('booking'));
    }

    public function update(Tour $tour, Booking $booking)
    {
        $booking->update(['payment_status' => 'Completed']);
        return redirect()->back()->with('success', 'Booking is Approved Successfully');
    }

    public function destroy(Tour $tour, Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking is Deleted Successfully');
    }
}