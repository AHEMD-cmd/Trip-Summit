<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->get();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin.post.create', compact('categories'));
    }

    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = uploadPhoto($request->file('photo'));
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post Created Successfully');
    }

    public function edit(Post $post)
    {
        $categories = Category::get();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {

            $data['photo'] = updatePhoto($request->photo, $post, 'post_images');

        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post Updated Successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully');
    }
}
