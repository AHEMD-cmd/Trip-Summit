<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __invoke()
    {
        $reviews = Auth::user()->reviews()->with('package')->get();
        return view('user.reviews', compact('reviews'));
    }
}
