<?php

namespace App\Livewire\Message;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Compose extends Component
{
    public ?int $recipientId = null;

    public string $body = '';

    public function mount(?int $recipientId = null)
    {
        $this->recipientId = $recipientId;
    }

    public function send()
    {
        $validated = $this->validate();

        $conversation = Conversation::create();
        $conversation->users()->attach([auth()->id(), $validated['recipientId']]);

        $conversation->messages()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        return redirect()->route('messages.show', $conversation->id);
    }

    protected function rules(): array
    {
        return [
            'recipientId' => ['required', 'integer', Rule::exists('users', 'id'), Rule::notIn([auth()->id()])],
            'body' => ['required', 'string'],
        ];
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('livewire.message.compose', compact('users'));
    }
}
