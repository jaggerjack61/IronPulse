<?php

namespace App\Livewire\Blog;

use App\Models\BlogPost;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $posts = BlogPost::with('user')
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.blog.index', compact('posts'));
    }
}
