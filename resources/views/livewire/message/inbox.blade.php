<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="lg" class="text-white font-display tracking-wide">{{ __('Conversations') }}</flux:heading>
        <flux:button :href="route('messages.compose')" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0" wire:navigate>
            {{ __('New Message') }}
        </flux:button>
    </div>

    <div class="space-y-3">
        @forelse($conversations as $conversation)
        <a href="{{ route('messages.show', $conversation->id) }}" wire:navigate class="block">
            <flux:card class="hover:border-orange-500/30 transition-all bg-gym-900 border-gym-700/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @php
                            $otherUser = $conversation->users->firstWhere('id', '!=', auth()->id());
                        @endphp
                        <flux:avatar :name="$otherUser?->name" :initials="$otherUser?->initials()" />
                        <div>
                            <flux:heading size="sm" class="text-white">{{ $otherUser?->name ?? 'Unknown' }}</flux:heading>
                            @if($conversation->latestMessage)
                            <flux:text class="text-sm text-gym-400 truncate max-w-md">
                                {{ Str::limit($conversation->latestMessage->body, 60) }}
                            </flux:text>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        @if($conversation->latestMessage)
                        <flux:text class="text-xs text-gym-500">{{ $conversation->latestMessage->created_at->diffForHumans() }}</flux:text>
                        @endif
                    </div>
                </div>
            </flux:card>
        </a>
        @empty
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:text class="text-center text-gym-400 py-8">{{ __('No conversations yet.') }}</flux:text>
        </flux:card>
        @endforelse
    </div>
</div>
