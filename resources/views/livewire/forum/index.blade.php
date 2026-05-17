<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($categories as $category)
        <a href="{{ route('forums.category', $category->slug) }}" wire:navigate class="block group">
            <flux:card class="hover:border-orange-500/50 transition-all h-full bg-gym-900 border-gym-700/50">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                        @php
                            $iconName = $category->icon ?? 'chat-bubble-left-right';
                            $iconView = 'flux.icon.' . $iconName;
                            if (! \Illuminate\Support\Facades\View::exists($iconView)) {
                                $iconName = 'chat-bubble-left-right';
                            }
                        @endphp
                        <flux:icon name="{{ $iconName }}" class="w-6 h-6 text-orange-500 group-hover:text-white transition-colors" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <flux:heading size="lg" class="mb-1 text-white font-display tracking-wide">{{ $category->name }}</flux:heading>
                        @if($category->description)
                        <flux:text class="text-sm text-gym-400 mb-2">{{ $category->description }}</flux:text>
                        @endif
                        <flux:badge size="sm" color="orange">{{ $category->forum_posts_count }} posts</flux:badge>
                    </div>
                </div>
            </flux:card>
        </a>
        @endforeach
    </div>

    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Latest Discussions') }}</flux:heading>
    <div class="space-y-4">
        @foreach($latestPosts as $post)
        <flux:card class="bg-gym-900 border-gym-700/50 hover:border-orange-500/30 transition-colors">
            <a href="{{ route('forums.show', [$post->forumCategory->slug, $post->slug]) }}" wire:navigate class="block">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:heading size="sm" class="mb-1 text-white">{{ $post->title }}</flux:heading>
                        <flux:text class="text-sm text-gym-400">
                            by {{ $post->user->name }} in {{ $post->forumCategory->name }}
                            · {{ $post->created_at->diffForHumans() }}
                        </flux:text>
                    </div>
                    <flux:badge size="sm" color="gym">{{ $post->views_count }} views</flux:badge>
                </div>
            </a>
        </flux:card>
        @endforeach
    </div>
</div>
