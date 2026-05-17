<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($posts as $post)
        <a href="{{ route('blog.show', $post->slug) }}" wire:navigate class="block group">
            <flux:card class="hover:border-lime-400/50 transition-all h-full bg-gym-900 border-gym-700/50">
                @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                @else
                <div class="w-full h-48 rounded-lg mb-4 bg-gradient-to-br from-gym-800 to-gym-900 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gym-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                @endif
                <flux:heading size="lg" class="mb-2 text-white font-display tracking-wide">{{ $post->title }}</flux:heading>
                @if($post->excerpt)
                <flux:text class="text-gym-400 mb-3">{{ $post->excerpt }}</flux:text>
                @endif
                <flux:text class="text-sm text-gym-500">
                    By {{ $post->user->name }} · {{ $post->published_at->diffForHumans() }}
                </flux:text>
            </flux:card>
        </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
