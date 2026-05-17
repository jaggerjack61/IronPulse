<div>
    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Edit Profile') }}</flux:heading>

    @if(session()->has('message'))
    <flux:card class="mb-4 bg-lime-400/10 border-lime-400/30">
        <flux:text class="text-lime-400">{{ session('message') }}</flux:text>
    </flux:card>
    @endif

    <flux:card class="bg-gym-900 border-gym-700/50">
        <form wire:submit="update">
            <flux:field>
                <flux:label class="text-gym-300">{{ __('Name') }}</flux:label>
                <flux:input wire:model="name" class="bg-gym-950 border-gym-700" />
                <flux:error name="name" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Bio') }}</flux:label>
                <flux:textarea wire:model="bio" rows="3" class="bg-gym-950 border-gym-700" />
                <flux:error name="bio" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Avatar') }}</flux:label>
                <flux:input type="file" wire:model="avatar" class="bg-gym-950 border-gym-700" />
                <flux:error name="avatar" />
            </flux:field>

            <div class="mt-4">
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Update Profile') }}</flux:button>
            </div>
        </form>
    </flux:card>
</div>
