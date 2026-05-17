<div>
    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Forum Categories') }}</flux:heading>

    <flux:card class="mb-6 bg-gym-900 border-gym-700/50">
        <form wire:submit="create" class="flex gap-4 items-end">
            <flux:field class="flex-1">
                <flux:label class="text-gym-300">{{ __('Name') }}</flux:label>
                <flux:input wire:model="name" class="bg-gym-950 border-gym-700" />
                <flux:error name="name" />
            </flux:field>
            <flux:field class="flex-1">
                <flux:label class="text-gym-300">{{ __('Description') }}</flux:label>
                <flux:input wire:model="description" class="bg-gym-950 border-gym-700" />
            </flux:field>
            <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Add') }}</flux:button>
        </form>
    </flux:card>

    <div class="space-y-3">
        @foreach($categories as $category)
        <flux:card class="bg-gym-900 border-gym-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <flux:heading size="sm" class="text-white">{{ $category->name }}</flux:heading>
                    <flux:text class="text-sm text-gym-400">{{ $category->description }}</flux:text>
                </div>
                <flux:button wire:click="delete({{ $category->id }})" variant="ghost" color="red" size="sm">
                    {{ __('Delete') }}
                </flux:button>
            </div>
        </flux:card>
        @endforeach
    </div>
</div>
