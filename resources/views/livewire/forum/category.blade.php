<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl" class="text-white font-display tracking-wide">{{ $category->name }}</flux:heading>
            @if($category->description)
            <flux:text class="text-gym-400">{{ $category->description }}</flux:text>
            @endif
        </div>
        @auth
        <flux:button variant="primary" wire:click="$toggle('showCreateForm')" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">
            {{ __('New Post') }}
        </flux:button>
        @endauth
    </div>

    @if($showCreateForm)
    <flux:card class="mb-6 bg-gym-900 border-gym-700/50">
        <form wire:submit="createPost">
            <flux:field>
                <flux:label class="text-gym-300">{{ __('Title') }}</flux:label>
                <flux:input wire:model="title" class="bg-gym-950 border-gym-700" />
                <flux:error name="title" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Body') }}</flux:label>
                <flux:textarea wire:model="body" rows="5" class="bg-gym-950 border-gym-700" />
                <flux:error name="body" />
            </flux:field>

            <div class="mt-4 flex gap-2">
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Post') }}</flux:button>
                <flux:button type="button" wire:click="$toggle('showCreateForm')" variant="ghost" class="text-gym-400 hover:text-white">{{ __('Cancel') }}</flux:button>
            </div>
        </form>
    </flux:card>
    @endif

    <div class="space-y-4">
        @foreach($posts as $post)
        <flux:card class="bg-gym-900 border-gym-700/50 hover:border-orange-500/30 transition-colors">
            <a href="{{ route('forums.show', [$category->slug, $post->slug]) }}" wire:navigate class="block">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            @if($post->pinned)
                            <flux:badge size="sm" color="orange">{{ __('Pinned') }}</flux:badge>
                            @endif
                            <flux:heading size="sm" class="text-white">{{ $post->title }}</flux:heading>
                        </div>
                        <flux:text class="text-sm text-gym-400">
                            by {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                            · {{ $post->views_count }} views
                        </flux:text>
                    </div>
                </div>
            </a>
        </flux:card>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
