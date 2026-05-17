<div>
    <div class="mb-4">
        <a href="{{ route('mailbox.index') }}" wire:navigate class="text-sm text-gym-400 hover:text-orange-400 transition-colors">
            ← {{ __('Back to Mailbox') }}
        </a>
    </div>

    <flux:card class="bg-gym-900 border-gym-700/50">
        <div class="flex items-center gap-3 mb-4">
            <flux:avatar :name="$message->sender->name" :initials="$message->sender->initials()" />
            <div>
                <flux:heading size="lg" class="text-white font-display tracking-wide">{{ $message->subject }}</flux:heading>
                <flux:text class="text-sm text-gym-400">
                    From {{ $message->sender->name }} · {{ $message->created_at->diffForHumans() }}
                </flux:text>
            </div>
        </div>

        <flux:separator class="border-gym-700/50" />

        <div class="mt-4 prose dark:prose-invert max-w-none text-gym-300">
            {!! nl2br(e($message->body)) !!}
        </div>
    </flux:card>
</div>
