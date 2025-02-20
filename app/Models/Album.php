<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'album_post');
    }
}
