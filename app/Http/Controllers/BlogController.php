<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index');
    }

    public function show(BlogPost $post)
    {
        abort_unless($post->isPublished(), 404);

        $post->load(['user', 'comments.user', 'comments.likes']);

        return view('blog.show', compact('post'));
    }
}
