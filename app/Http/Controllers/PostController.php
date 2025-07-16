<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Public frontend methods
    public function index()
    {
        $posts = Post::published()->latest()->get();
        return view('posts.index', compact('posts'));
    }

    function showPostsByUser()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('user.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published' && (!Auth::check() || Auth::id() !== $post->user_id)) {
            abort(403);
        }
        
        return view('posts.show', compact('post'));
    }

    // User panel methods
    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
        ]);

        $data = $request->only(['title', 'content']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('user.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id() || !in_array($post->status, ['pending', 'rejected'])) {
            abort(403);
        }

        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id() || !in_array($post->status, ['pending', 'rejected'])) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('user.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id() || !in_array($post->status, ['pending', 'rejected'])) {
            abort(403);
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('user.posts.index')->with('success', 'Post deleted successfully!');
    }

    public function adminIndex()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function updateStatus(Request $request, Post $post)
    {
        $request->validate([
            'status' => 'required|in:pending,published,rejected'
        ]);

        $post->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}