<?php

namespace App\Livewire\Forum;

use App\Models\ForumCategory;
use App\Models\ForumPost;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Category extends Component
{
    public ForumCategory $category;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string')]
    public string $body = '';

    public bool $showCreateForm = false;

    public function mount(ForumCategory $category)
    {
        $this->category = $category;
    }

    public function createPost()
    {
        abort_unless(auth()->check(), 403);

        $this->validate();

        $post = ForumPost::create([
            'user_id' => auth()->id(),
            'forum_category_id' => $this->category->id,
            'title' => $this->title,
            'slug' => Str::slug($this->title).'-'.uniqid(),
            'body' => $this->body,
        ]);

        $this->reset(['title', 'body', 'showCreateForm']);
        $this->dispatch('post-created');
    }

    public function render()
    {
        $posts = ForumPost::with('user')
            ->where('forum_category_id', $this->category->id)
            ->orderByDesc('pinned')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('livewire.forum.category', compact('posts'));
    }
}
