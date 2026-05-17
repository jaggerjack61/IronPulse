<div>
    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Create Blog Post') }}</flux:heading>

    @if(session()->has('message'))
    <flux:card class="mb-4 bg-lime-400/10 border-lime-400/30">
        <flux:text class="text-lime-400">{{ session('message') }}</flux:text>
    </flux:card>
    @endif

    <flux:card class="bg-gym-900 border-gym-700/50">
        <form wire:submit="save">
            <flux:field>
                <flux:label class="text-gym-300">{{ __('Title') }}</flux:label>
                <flux:input wire:model="title" class="bg-gym-950 border-gym-700" />
                <flux:error name="title" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Excerpt') }}</flux:label>
                <flux:textarea wire:model="excerpt" rows="2" class="bg-gym-950 border-gym-700" />
                <flux:error name="excerpt" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Body') }}</flux:label>
                <flux:textarea wire:model="body" rows="10" class="bg-gym-950 border-gym-700" />
                <flux:error name="body" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:checkbox wire:model="publish" :label="__('Publish immediately')" />
            </flux:field>

            <div class="mt-4">
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Create Post') }}</flux:button>
            </div>
        </form>
    </flux:card>
</div>
