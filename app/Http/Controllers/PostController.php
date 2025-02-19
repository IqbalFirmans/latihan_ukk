<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->keyword) {
            $posts = Post::search($request->keyword)->get();
        } else {
            $posts = Post::all();
        }

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validateData = $request->validated();

        try {
            $validateData['user_id'] = Auth::user()->id;
            $validateData['image'] = $request->file('image')->store('post-images');

            Post::create($validateData);

            return redirect()->back()->with('success', 'Upload Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Upload failed!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $posts = Post::all();

        return view('post.show', compact('post', 'posts'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $validateData = $request->validated();

        try {
            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::delete($post->image);
                }
                $validateData['image'] = $request->file('image')->store('post-images');
            }
            $post->update($validateData);

            return back()->with('success', 'Update Post Success!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Update Post failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        try {
            Storage::delete($post->image);

            $post->delete();

            return back()->with('success', 'Delete Post Success!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Delete Post failed!');
        }
    }
}
