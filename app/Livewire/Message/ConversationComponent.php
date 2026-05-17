<?php

namespace App\Livewire\Message;

use App\Events\NewMessage;
use App\Models\Conversation;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ConversationComponent extends Component
{
    public Conversation $conversation;

    #[Validate('required|string')]
    public string $body = '';

    public function mount(int $conversationId)
    {
        $this->conversation = Conversation::with(['users', 'messages.user'])->findOrFail($conversationId);
        $this->authorizeParticipant();
        $this->markMessagesAsRead();
    }

    #[On('echo-private:conversation.{conversation.id},NewMessage')]
    public function onNewMessage()
    {
        $this->conversation->load('messages.user');
        $this->markMessagesAsRead();
    }

    public function markMessagesAsRead(): void
    {
        $this->conversation->messages()
            ->where('user_id', '!=', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function sendMessage()
    {
        $this->authorizeParticipant();
        $this->validate();

        $message = $this->conversation->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);

        $this->conversation->touch();
        NewMessage::dispatch($message);

        $this->reset('body');
        $this->conversation->load('messages.user');
    }

    private function authorizeParticipant(): void
    {
        abort_unless($this->conversation->users()->whereKey(auth()->id())->exists(), 403);
    }

    public function render()
    {
        return view('livewire.message.conversation');
    }
}
