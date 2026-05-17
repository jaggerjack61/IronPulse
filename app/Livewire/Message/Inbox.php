<?php

namespace App\Livewire\Message;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Inbox extends Component
{
    #[Validate('required|string')]
    public string $search = '';

    public function render()
    {
        $conversations = auth()->user()
            ->conversations()
            ->with(['users', 'latestMessage'])
            ->withCount(['messages as unread_count' => function ($query) {
                $query->where('user_id', '!=', auth()->id())->whereNull('read_at');
            }])
            ->latest('updated_at')
            ->get();

        return view('livewire.message.inbox', compact('conversations'));
    }
}
