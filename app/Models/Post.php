<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Post extends Model
{
    use Commentable;
    
    protected $guarded = [];

    
    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_post', 'post_id', 'album_id');
    }
}
