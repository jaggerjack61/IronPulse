<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumPost;

class ForumController extends Controller
{
    public function index()
    {
        return view('forums.index');
    }

    public function category(ForumCategory $category)
    {
        return view('forums.category', compact('category'));
    }

    public function show(ForumCategory $category, ForumPost $forumPost)
    {
        $post = $forumPost;

        $post->load(['user', 'comments.user', 'comments.likes']);
        $post->incrementViews();

        return view('forums.show', compact('category', 'post'));
    }

    public function create(ForumCategory $category)
    {
        return redirect()->route('forums.category', $category->slug);
    }
}
