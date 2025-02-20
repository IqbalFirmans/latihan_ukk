<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Post extends Model
{
    use Commentable, Searchable;
    
    protected $guarded = [];

    
    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function toSearchableArray(): array
    {
      return [
        'title' => $this->title,
      ];
  }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_post');
    }
}
