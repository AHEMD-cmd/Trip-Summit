<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(9);
        return view('front.blog', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->first();
        $latestPosts = Post::with('category')->orderBy('id', 'desc')->limit(3)->get();
        $categories = Category::all();
        return view('front.post', compact('post', 'latestPosts', 'categories'));
    }
}
