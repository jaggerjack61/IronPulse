<div>
    <div class="mb-4">
        <a href="{{ route('messages.index') }}" wire:navigate class="text-sm text-gym-400 hover:text-orange-400 transition-colors">
            ← {{ __('Back to Inbox') }}
        </a>
    </div>

    <flux:card class="h-[60vh] flex flex-col bg-gym-900 border-gym-700/50">
        <div class="flex-1 overflow-y-auto space-y-4 p-4" id="messages-container">
            @foreach($conversation->messages->sortBy('created_at') as $message)
            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[70%] {{ $message->user_id === auth()->id() ? 'bg-orange-500 text-white' : 'bg-gym-800 text-gym-100' }} rounded-lg px-4 py-2">
                    <div class="text-sm font-medium mb-1 {{ $message->user_id === auth()->id() ? 'text-orange-100' : 'text-gym-400' }}">
                        {{ $message->user->name }}
                    </div>
                    <div>{{ $message->body }}</div>
                    <div class="text-xs mt-1 {{ $message->user_id === auth()->id() ? 'text-orange-200' : 'text-gym-500' }}">
                        {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="border-t border-gym-700/50 p-4">
            <form wire:submit="sendMessage" class="flex gap-2">
                <flux:input wire:model="body" placeholder="{{ __('Type a message...') }}" class="flex-1 bg-gym-950 border-gym-700" />
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Send') }}</flux:button>
            </form>
            <flux:error name="body" />
        </div>
    </flux:card>

    <script>
        document.addEventListener('livewire:initialized', () => {
            const container = document.getElementById('messages-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>
</div>
