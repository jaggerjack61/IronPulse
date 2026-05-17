<div wire:key="comment-{{ $comment->id }}">
    <flux:card class="{{ $comment->parent_id ? 'ml-8' : '' }} bg-gym-900 border-gym-700/50">
        <div class="flex items-start gap-3">
            <flux:avatar :name="$comment->user->name" :initials="$comment->user->initials()" size="sm" />
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <flux:text class="font-medium text-sm text-white">{{ $comment->user->name }}</flux:text>
                    <flux:text class="text-xs text-gym-500">{{ $comment->created_at->diffForHumans() }}</flux:text>
                </div>
                <div class="text-sm mb-2 text-gym-300">{{ $comment->body }}</div>
                <div class="flex items-center gap-3">
                    <livewire:components.like-button :likeable="$comment" type="like" />
                    @auth
                    <flux:button wire:click="toggleReplyForm" variant="ghost" size="sm" class="text-gym-400 hover:text-orange-400">
                        {{ __('Reply') }}
                    </flux:button>
                    @endauth
                </div>

                @if($showReplyForm)
                <form wire:submit="addReply" class="mt-3">
                    <flux:textarea wire:model="replyBody" rows="2" placeholder="{{ __('Write a reply...') }}" class="bg-gym-950 border-gym-700" />
                    <flux:error name="replyBody" />
                    <div class="mt-2 flex gap-2">
                        <flux:button type="submit" variant="primary" size="sm" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Reply') }}</flux:button>
                        <flux:button type="button" wire:click="$toggle('showReplyForm')" variant="ghost" size="sm" class="text-gym-400 hover:text-white">{{ __('Cancel') }}</flux:button>
                    </div>
                </form>
                @endif

                @if($comment->replies->count() > 0)
                <div class="mt-4 space-y-3">
                    @foreach($comment->replies as $reply)
                    <div class="ml-4 border-l-2 border-gym-700 pl-4">
                        <div class="flex items-start gap-2">
                            <flux:avatar :name="$reply->user->name" :initials="$reply->user->initials()" size="xs" />
                            <div>
                                <div class="flex items-center gap-2">
                                    <flux:text class="font-medium text-sm text-white">{{ $reply->user->name }}</flux:text>
                                    <flux:text class="text-xs text-gym-500">{{ $reply->created_at->diffForHumans() }}</flux:text>
                                </div>
                                <div class="text-sm text-gym-300">{{ $reply->body }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </flux:card>
</div>
