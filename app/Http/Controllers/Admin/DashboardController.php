<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Post;
use App\Models\Destination;
use App\Models\Package;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\Tour;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalSlider = Slider::count();
        $totalTestimonial = Testimonial::count();
        $totalTeam_members = TeamMember::count();
        $totalPosts = Post::count();
        $totalDestinations = Destination::count();
        $totalPackages = Package::count();
        $totalUsers = User::where('status', 1)->count();
        $totalSubscribers = Subscriber::where('status', 'Active')->count();
        $totalTours = Tour::count();

        return view('admin.dashboard', compact(
            'totalSlider',
            'totalTestimonial',
            'totalTeam_members',
            'totalPosts',
            'totalDestinations',
            'totalPackages',
            'totalUsers',
            'totalSubscribers',
            'totalTours'
        ));
    }
}
