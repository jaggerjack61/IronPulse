<div>
    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Mailbox') }}</flux:heading>

    <div class="space-y-3">
        @forelse($messages as $message)
        <a href="{{ route('mailbox.show', $message->id) }}" wire:navigate class="block">
            <flux:card class="hover:border-orange-500/30 transition-all {{ $message->read_at ? 'opacity-75' : '' }} bg-gym-900 border-gym-700/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <flux:avatar :name="$message->sender->name" :initials="$message->sender->initials()" />
                        <div>
                            <div class="flex items-center gap-2">
                                <flux:heading size="sm" class="text-white">{{ $message->subject }}</flux:heading>
                                @if(! $message->read_at)
                                <flux:badge size="sm" color="red">{{ __('New') }}</flux:badge>
                                @endif
                            </div>
                            <flux:text class="text-sm text-gym-400">
                                From {{ $message->sender->name }} · {{ $message->created_at->diffForHumans() }}
                            </flux:text>
                        </div>
                    </div>
                </div>
            </flux:card>
        </a>
        @empty
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:text class="text-center text-gym-400 py-8">{{ __('No messages in your mailbox.') }}</flux:text>
        </flux:card>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
