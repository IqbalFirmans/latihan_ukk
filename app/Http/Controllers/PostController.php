<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $user)
    {
        $user = User::where('name', $user)->first();
        $posts = Post::where('user_id', $user->id)->get();
        $albums = Album::where('user_id', $user->id)->with('posts')->get();

        return view('post.index', compact('posts', 'user', 'albums'));
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
        
        $albums = Album::where('user_id', Auth::user()->id)->get();
        
        return view('post.show', compact('post', 'posts', 'albums'));
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

            if ($request->has('albums')) {
                $post->albums()->sync($request->input('albums'));
            } else {
                $post->albums()->detach();
            }

            return back()->with('success', 'Update Post Success!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Update Post failed!' . $th->getMessage());
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
