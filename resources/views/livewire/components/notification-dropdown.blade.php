<div>
    <flux:dropdown position="bottom" align="end">
        <flux:button variant="ghost" size="sm" icon="bell" class="relative text-gym-400 hover:text-white">
            @if($notifications->where('read_at', null)->count() > 0)
            <span class="absolute -top-1 -right-1 h-4 w-4 rounded-full bg-orange-500 text-white text-xs flex items-center justify-center">
                {{ $notifications->where('read_at', null)->count() }}
            </span>
            @endif
        </flux:button>

        <flux:menu class="w-80 bg-gym-900 border-gym-700/50">
            <div class="p-3 border-b border-gym-700/50 flex items-center justify-between">
                <flux:heading size="sm" class="text-white">{{ __('Notifications') }}</flux:heading>
                <flux:button wire:click="markAllRead" variant="ghost" size="sm" class="text-gym-400 hover:text-white">{{ __('Mark all read') }}</flux:button>
            </div>

            <div class="max-h-80 overflow-y-auto">
                @forelse($notifications as $notification)
                <div class="p-3 {{ $notification->read_at ? 'opacity-50' : 'bg-gym-800/50' }} border-b border-gym-800">
                    <flux:text class="text-sm text-gym-200">{{ $notification->data['message'] ?? 'New notification' }}</flux:text>
                    <flux:text class="text-xs text-gym-500">{{ $notification->created_at->diffForHumans() }}</flux:text>
                </div>
                @empty
                <div class="p-4 text-center">
                    <flux:text class="text-sm text-gym-400">{{ __('No notifications') }}</flux:text>
                </div>
                @endforelse
            </div>
        </flux:menu>
    </flux:dropdown>
</div>
