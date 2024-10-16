<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'approved')->get();
        return view('welcome')->with(compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => 'pending', // Default status is pending
        ]);

        return redirect()->route('home')->with('success', 'Post submitted for approval!');
    }

    public function approve(Post $post)
    {
        $post->update(['status' => 'approved']);

        return redirect()->route('home')->with('success', 'Post approved!');
    }

    public function edit(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('home')->with('success', 'Post updated successfully!');
    }

    public function delete(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }

    public function show(Post $post)
    {
        return view('post', compact('post'));
    }
}
