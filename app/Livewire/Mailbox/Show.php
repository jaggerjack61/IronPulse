<?php

namespace App\Livewire\Mailbox;

use App\Models\MailboxMessage;
use Livewire\Component;

class Show extends Component
{
    public MailboxMessage $message;

    public function mount(int $messageId)
    {
        $this->message = MailboxMessage::findOrFail($messageId);

        if ($this->message->recipient_id !== auth()->id()) {
            abort(403);
        }

        $this->message->markAsRead();
    }

    public function render()
    {
        return view('livewire.mailbox.show');
    }
}
