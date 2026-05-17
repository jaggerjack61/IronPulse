<div>
    <flux:card class="mb-6 bg-gym-900 border-gym-700/50">
        <div class="flex items-start gap-4">
            <flux:avatar :name="$post->user->name" :initials="$post->user->initials()" />
            <div class="flex-1">
                <flux:heading size="xl" class="mb-2 text-white font-display tracking-wide">{{ $post->title }}</flux:heading>
                <flux:text class="text-sm text-gym-400 mb-4">
                    Published by {{ $post->user->name }} · {{ $post->published_at?->diffForHumans() }}
                </flux:text>
                @if($post->excerpt)
                <flux:text class="text-lg text-gym-300 mb-4 italic">{{ $post->excerpt }}</flux:text>
                @endif
                <div class="prose dark:prose-invert max-w-none text-gym-300">
                    {!! nl2br(e($post->body)) !!}
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <livewire:components.like-button :likeable="$post" type="like" />
                    <livewire:components.like-button :likeable="$post" type="dislike" />
                </div>
            </div>
        </div>
    </flux:card>

    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Comments') }} ({{ $comments->count() }})</flux:heading>

    @auth
    <flux:card class="mb-6 bg-gym-900 border-gym-700/50">
        <form wire:submit="addComment">
            <flux:field>
                <flux:label class="text-gym-300">{{ __('Add a comment') }}</flux:label>
                <flux:textarea wire:model="commentBody" rows="3" class="bg-gym-950 border-gym-700" />
                <flux:error name="commentBody" />
            </flux:field>
            <div class="mt-3">
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Comment') }}</flux:button>
            </div>
        </form>
    </flux:card>
    @endauth

    <div class="space-y-4">
        @foreach($comments as $comment)
            <livewire:components.comment-section :comment="$comment" wire:key="blog-comment-{{ $comment->id }}" />
        @endforeach
    </div>
</div>
