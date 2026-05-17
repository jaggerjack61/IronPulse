<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist aria-label="{{ __('Settings') }}">
            <flux:navlist.item :href="route('profile.edit')" wire:navigate class="text-gym-300 hover:text-white">{{ __('Profile') }}</flux:navlist.item>
            <flux:navlist.item :href="route('security.edit')" wire:navigate class="text-gym-300 hover:text-white">{{ __('Security') }}</flux:navlist.item>
            <flux:navlist.item :href="route('appearance.edit')" wire:navigate class="text-gym-300 hover:text-white">{{ __('Appearance') }}</flux:navlist.item>
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden border-gym-700/50" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading class="font-display text-2xl text-white tracking-wide">{{ $heading ?? '' }}</flux:heading>
        <flux:subheading class="text-gym-400">{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
