<div>
    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('New Message') }}</flux:heading>

    <flux:card class="bg-gym-900 border-gym-700/50">
        <form wire:submit="send">
            <flux:field>
                <flux:label class="text-gym-300">{{ __('Recipient') }}</flux:label>
                <flux:select wire:model="recipientId" class="bg-gym-950 border-gym-700">
                    <option value="">{{ __('Select a user...') }}</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="recipientId" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Message') }}</flux:label>
                <flux:textarea wire:model="body" rows="4" class="bg-gym-950 border-gym-700" />
                <flux:error name="body" />
            </flux:field>

            <div class="mt-4">
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Send Message') }}</flux:button>
            </div>
        </form>
    </flux:card>
</div>
