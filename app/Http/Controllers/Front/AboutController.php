<?php

namespace App\Http\Controllers\Front;

use App\Models\Feature;
use App\Models\AboutItem;
use App\Models\CounterItem;
use App\Models\WelcomeItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $welcomeItem = WelcomeItem::first();
        $features = Feature::all();
        $counterItem = CounterItem::first();
        $aboutItem = AboutItem::first();
        return view('front.about', compact('welcomeItem', 'features', 'counterItem', 'aboutItem'));
    }
}
