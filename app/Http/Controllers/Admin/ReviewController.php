<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Package;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'package'])->get();
        return view('admin.review.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Review is Deleted Successfully');
    }
}
