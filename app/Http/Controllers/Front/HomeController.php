<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Package;
use App\Models\HomeItem;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\WelcomeItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $sliders = Slider::all();
        $welcomeItem = WelcomeItem::first();
        $features = Feature::all();
        $testimonials = Testimonial::all();
        $destinations = Destination::orderBy('view_count', 'desc')->get()->take(8);
        $posts = Post::with('category')->orderBy('id', 'desc')->get()->take(3);
        $packages = Package::with(['destination', 'packageAmenities', 'packageItineraries', 'tours', 'reviews'])->orderBy('id', 'desc')->get()->take(3);
        $homeItem = HomeItem::first();

        return view('front.home', compact('sliders', 'welcomeItem', 'features', 'testimonials', 'posts', 'destinations', 'packages', 'homeItem'));
    }
}
