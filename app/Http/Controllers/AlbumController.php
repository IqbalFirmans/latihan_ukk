<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // private $user;

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $this->user = Auth::user()->id;
    //         return $next($request);
    //     });
    // }

    public function show(string $album)
    {   
        $album = Album::where('name', $album)->with('posts')->first();
        $albums = Album::all();

        return view('album.show', compact('album', 'albums'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'albums' => 'required|array'
        ]);

        
        try {
            $post = Post::findOrFail($request->input('post_id'));
    
            $post->albums()->syncWithoutDetaching($request->input('albums'));
            
            return redirect()->back()->with('success', 'Save to album success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Save to album failed!' . $th->getMessage());
        }
    }

    public function store(AlbumRequest $request)
    {
        $validate = $request->validated();

        try {
            $validate['user_id'] = Auth::user()->id;

            Album::create($validate);

            return redirect()->back()->with('success', 'Create album success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Create album failed!');
        }
    }

    public function update(AlbumRequest $request, Album $album)
    {
        $validate = $request->validated();

        try {
            $album->update($validate);

            return redirect()->back()->with('success', 'Update album success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Update album failed!');
        }
    }

    public function destroy(Album $album)
    {
        try {
            $album->delete();

            return redirect()->back()->with('success', 'Delete album success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Delete album failed!');
        }
    }
}
