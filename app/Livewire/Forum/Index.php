<?php

namespace App\Livewire\Forum;

use App\Models\ForumCategory;
use App\Models\ForumPost;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $categories = ForumCategory::withCount('forumPosts')
            ->orderBy('sort_order')
            ->get();

        $latestPosts = ForumPost::with(['user', 'forumCategory'])
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.forum.index', compact('categories', 'latestPosts'));
    }
}
