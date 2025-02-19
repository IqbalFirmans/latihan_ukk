<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function blogPost(Request $request)
    {
        if ($request->keyword) {
            $posts = Post::search($request->keyword)->get();
        } else {
            $posts = Post::all();
        }

        return view('posts', compact('posts'));
    }
}
