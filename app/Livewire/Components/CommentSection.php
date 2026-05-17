<?php

namespace App\Livewire\Components;

use App\Models\Comment;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentSection extends Component
{
    public Comment $comment;

    #[Validate('required|string')]
    public string $replyBody = '';

    public bool $showReplyForm = false;

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function toggleReplyForm()
    {
        $this->showReplyForm = ! $this->showReplyForm;
    }

    public function addReply()
    {
        abort_unless(auth()->check(), 403);

        $this->validate();

        $this->comment->replies()->create([
            'user_id' => auth()->id(),
            'commentable_id' => $this->comment->commentable_id,
            'commentable_type' => $this->comment->commentable_type,
            'body' => $this->replyBody,
        ]);

        $this->reset(['replyBody', 'showReplyForm']);
        $this->dispatch('reply-added');
    }

    public function render()
    {
        return view('livewire.components.comment-section');
    }
}
