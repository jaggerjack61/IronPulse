<?php

namespace App\Livewire\Mailbox;

use App\Models\MailboxMessage;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $messages = MailboxMessage::with('sender')
            ->where('recipient_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('livewire.mailbox.index', compact('messages'));
    }
}
