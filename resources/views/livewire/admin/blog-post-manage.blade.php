<div>
    <div class="flex items-center justify-between mb-4">
        <flux:heading size="lg" class="text-white font-display tracking-wide">{{ __('Manage Blog Posts') }}</flux:heading>
        <flux:button :href="route('admin.blog.create')" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0" wire:navigate>
            {{ __('New Post') }}
        </flux:button>
    </div>

    <div class="space-y-3">
        @foreach($posts as $post)
        <flux:card class="bg-gym-900 border-gym-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <flux:heading size="sm" class="text-white">{{ $post->title }}</flux:heading>
                    <flux:text class="text-sm text-gym-400">
                        {{ $post->published_at?->diffForHumans() ?? __('Draft') }}
                    </flux:text>
                </div>
                <flux:button wire:click="delete({{ $post->id }})" variant="ghost" color="red" size="sm">
                    {{ __('Delete') }}
                </flux:button>
            </div>
        </flux:card>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
