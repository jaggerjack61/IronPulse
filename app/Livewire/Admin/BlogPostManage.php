<?php

namespace App\Livewire\Admin;

use App\Models\BlogPost;
use Livewire\Component;

class BlogPostManage extends Component
{
    public function delete(int $id)
    {
        BlogPost::find($id)?->delete();
    }

    public function render()
    {
        $posts = BlogPost::with('user')->latest()->paginate(10);

        return view('livewire.admin.blog-post-manage', compact('posts'));
    }
}
