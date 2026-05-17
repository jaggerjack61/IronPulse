<div class="inline-block">
    <flux:button
        wire:click="toggleFollow"
        variant="{{ $isFollowing ? 'outline' : 'primary' }}"
        size="sm"
        class="{{ $isFollowing ? 'border-gym-600 text-gym-300 hover:border-orange-500 hover:text-orange-400' : 'bg-gradient-to-r from-orange-500 to-orange-600 border-0' }}"
    >
        {{ $isFollowing ? __('Following') : __('Follow') }}
    </flux:button>
</div>
