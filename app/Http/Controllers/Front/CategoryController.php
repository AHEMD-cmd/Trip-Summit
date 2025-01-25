<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::with('category')->where('category_id', $category->id)->orderBy('id', 'desc')->paginate(9);
        return view('front.category', compact('posts', 'category'));
    }
}
