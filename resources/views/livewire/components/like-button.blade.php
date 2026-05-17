<div class="inline-flex">
    <flux:button
        wire:click="toggleLike"
        variant="ghost"
        size="sm"
        :class="$isActive ? 'text-orange-500' : 'text-gym-400'"
    >
        <span class="flex items-center gap-1">
            @if($type === 'like')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $isActive ? 'fill-current' : '' }}" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                </svg>
                {{ $count }}
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $isActive ? 'fill-current' : '' }}" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667V4.237a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.38 12h3.56v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                </svg>
                {{ $count }}
            @endif
        </span>
    </flux:button>
</div>
