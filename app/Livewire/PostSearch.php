<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostSearch extends Component
{
    public $search = '';

    public function render()
    {
        return view('posts', [
            'posts' => Post::where('title', $this->search)->get(),
        ]);
    }
}
