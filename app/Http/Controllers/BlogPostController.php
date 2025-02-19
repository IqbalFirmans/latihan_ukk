<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function blogPost()
    {
        $posts = Post::all();

        return view('posts', compact('posts'));
    }
}
