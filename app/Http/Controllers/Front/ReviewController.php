<?php

namespace App\Http\Controllers\Front;

use App\Models\Review;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Front\ReviewFormRequest;

class ReviewController extends Controller
{
    public function __invoke(ReviewFormRequest $request, Package $package)
    {
        Review::create($request->validated());

        $package->total_rating = $package->total_rating + 1;
        $package->total_score = $package->total_score + $request->rating;
        $package->update();

        return redirect()->back()->with('success', 'Review is submitted successfully!');
    }
}
