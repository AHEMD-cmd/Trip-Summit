<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $user = User::with('bookings')->find(Auth::id());

        $totalCompletedOrders = $user->bookings
            ->where('payment_status', 'Completed')
            ->count();

        $totalPendingOrders = $user->bookings
            ->where('payment_status', 'Pending')
            ->count();

        // Pass the data to the view
        return view('user.dashboard', compact('totalCompletedOrders', 'totalPendingOrders'));
    }
}