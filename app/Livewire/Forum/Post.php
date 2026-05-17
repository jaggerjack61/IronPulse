<?php

namespace App\Livewire\Forum;

use App\Models\ForumPost;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Post extends Component
{
    public ForumPost $post;

    #[Validate('required|string')]
    public string $commentBody = '';

    public function mount(ForumPost $post)
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

        return view('livewire.forum.post', compact('comments'));
    }
}
