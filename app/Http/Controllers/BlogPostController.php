<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function blogPost(Request $request)
    {
        if ($request->keyword) {
            $posts = Post::search($request->keyword)->get();
        } else {
            $posts = Post::all();
        }

        $albums = Album::where('user_id', Auth::user()->id)->get();

        return view('posts', compact('posts', 'albums'));
    }
}
