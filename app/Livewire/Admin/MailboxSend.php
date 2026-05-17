<?php

namespace App\Livewire\Admin;

use App\Models\MailboxMessage;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MailboxSend extends Component
{
    #[Validate('required|exists:users,id')]
    public ?int $recipientId = null;

    #[Validate('required|string|max:255')]
    public string $subject = '';

    #[Validate('required|string')]
    public string $body = '';

    public function send()
    {
        $this->validate();

        MailboxMessage::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $this->recipientId,
            'subject' => $this->subject,
            'body' => $this->body,
        ]);

        $this->reset();
        session()->flash('message', 'Message sent successfully.');
    }

    public function render()
    {
        $users = User::where('role', 'user')->get();

        return view('livewire.admin.mailbox-send', compact('users'));
    }
}
