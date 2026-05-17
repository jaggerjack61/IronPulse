<div>
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-gym-900 to-gym-800 border border-gym-700/50 p-8 mb-6">
        <div class="absolute top-0 right-0 w-48 h-48 bg-orange-500/10 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
        <div class="relative z-10 flex items-center gap-4">
            <flux:avatar :name="$user->name" :initials="$user->initials()" size="lg" />
            <div>
                <flux:heading size="xl" class="text-white font-display tracking-wide">{{ $user->name }}</flux:heading>
                @if($user->bio)
                <flux:text class="text-gym-400">{{ $user->bio }}</flux:text>
                @endif
            </div>
        </div>
    </div>

    @if(auth()->check() && auth()->id() !== $user->id)
    <div class="mb-6">
        <livewire:components.follow-button :user="$user" />
    </div>
    @endif

    <div class="grid grid-cols-3 gap-4 mb-6">
        <flux:card class="text-center bg-gym-900 border-gym-700/50">
            <flux:heading size="2xl" class="text-orange-500">{{ $user->forum_posts_count }}</flux:heading>
            <flux:text class="text-sm text-gym-400">{{ __('Posts') }}</flux:text>
        </flux:card>
        <flux:card class="text-center bg-gym-900 border-gym-700/50">
            <flux:heading size="2xl" class="text-lime-400">{{ $user->followers_count ?? 0 }}</flux:heading>
            <flux:text class="text-sm text-gym-400">{{ __('Followers') }}</flux:text>
        </flux:card>
        <flux:card class="text-center bg-gym-900 border-gym-700/50">
            <flux:heading size="2xl" class="text-orange-500">{{ $user->following_count ?? 0 }}</flux:heading>
            <flux:text class="text-sm text-gym-400">{{ __('Following') }}</flux:text>
        </flux:card>
    </div>

    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Recent Posts') }}</flux:heading>
    <div class="space-y-3">
        @forelse($posts as $post)
        <flux:card class="bg-gym-900 border-gym-700/50 hover:border-orange-500/30 transition-colors">
            <a href="{{ route('forums.show', [$post->forumCategory->slug, $post->slug]) }}" wire:navigate class="block">
                <flux:heading size="sm" class="text-white">{{ $post->title }}</flux:heading>
                <flux:text class="text-sm text-gym-400">
                    {{ $post->forumCategory->name }} · {{ $post->created_at->diffForHumans() }}
                </flux:text>
            </a>
        </flux:card>
        @empty
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:text class="text-center text-gym-400 py-4">{{ __('No posts yet.') }}</flux:text>
        </flux:card>
        @endforelse
    </div>
</div>
