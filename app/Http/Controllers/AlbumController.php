<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->id;
            return $next($request);
        });
    }

    public function store(AlbumRequest $request)
    {
        $validate = $request->validated();

        try {
            $validate['user_id'] = $this->user;

            Album::create($validate);

            return to_route('gallery.index', $this->user)->with('success', 'Create album success!');
        } catch (\Throwable $th) {
            return to_route('gallery.index', $this->user)->with('error', 'Create album failed!');
        }
    }

    public function update(AlbumRequest $request, Album $album)
    {
        $validate = $request->validated();

        try {
            $album->update($validate);

            return to_route('gallery.index', $this->user)->with('success', 'Update album success!');
        } catch (\Throwable $th) {
            return to_route('gallery.index', $this->user)->with('error', 'Update album failed!');
        }
    }

    public function destroy(Album $album)
    {
        try {
            $album->delete();

            return to_route('gallery.index', $this->user)->with('success', 'Delete album success!');
        } catch (\Throwable $th) {
            return to_route('gallery.index', $this->user)->with('error', 'Delete album failed!');
        }
    }
}
