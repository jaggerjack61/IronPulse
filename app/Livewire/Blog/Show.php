<?php

namespace App\Livewire\Blog;

use App\Models\BlogPost;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    public BlogPost $post;

    #[Validate('required|string')]
    public string $commentBody = '';

    public function mount(BlogPost $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        abort_unless(auth()->check(), 403);

        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $this->commentBody,
        ]);

        $this->reset('commentBody');
        $this->dispatch('comment-added');
    }

    public function render()
    {
        $comments = $this->post->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return view('livewire.blog.show', compact('comments'));
    }
}
