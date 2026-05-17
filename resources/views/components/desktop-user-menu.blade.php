@props([
    'name' => null,
])

<flux:dropdown {{ $attributes->merge(['position' => 'bottom', 'align' => 'start']) }}>
    <flux:sidebar.profile
        :name="auth()->user()->name"
        :initials="auth()->user()->initials()"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"
        class="text-gym-100"
    />

    <flux:menu class="bg-gym-900 border-gym-700/50">
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            <flux:avatar
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate text-white">{{ auth()->user()->name }}</flux:heading>
                <flux:text class="truncate text-gym-400">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator class="border-gym-700/50" />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.show', auth()->id())" icon="user" wire:navigate class="text-gym-300 hover:text-white">
                {{ __('Profile') }}
            </flux:menu.item>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="text-gym-300 hover:text-white">
                {{ __('Settings') }}
            </flux:menu.item>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer text-gym-300 hover:text-white"
                    data-test="logout-button"
                >
                    {{ __('Log out') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
