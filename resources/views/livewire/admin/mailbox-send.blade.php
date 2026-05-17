<div>
    <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Send Mailbox Message') }}</flux:heading>

    @if(session()->has('message'))
    <flux:card class="mb-4 bg-lime-400/10 border-lime-400/30">
        <flux:text class="text-lime-400">{{ session('message') }}</flux:text>
    </flux:card>
    @endif

    <flux:card class="bg-gym-900 border-gym-700/50">
        <form wire:submit="send">
            <flux:field>
                <flux:label class="text-gym-300">{{ __('Recipient') }}</flux:label>
                <flux:select wire:model="recipientId" class="bg-gym-950 border-gym-700">
                    <option value="">{{ __('Select a user...') }}</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </flux:select>
                <flux:error name="recipientId" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Subject') }}</flux:label>
                <flux:input wire:model="subject" class="bg-gym-950 border-gym-700" />
                <flux:error name="subject" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label class="text-gym-300">{{ __('Message') }}</flux:label>
                <flux:textarea wire:model="body" rows="8" class="bg-gym-950 border-gym-700" />
                <flux:error name="body" />
            </flux:field>

            <div class="mt-4">
                <flux:button type="submit" variant="primary" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0">{{ __('Send') }}</flux:button>
            </div>
        </form>
    </flux:card>
</div>
