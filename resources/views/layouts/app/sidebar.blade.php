<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gym-950 text-gym-100 antialiased">
        <flux:sidebar sticky collapsible class="border-e border-gym-700/50 bg-gym-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ auth()->check() ? route('dashboard') : route('home') }}" wire:navigate />
                <ui-sidebar-toggle class="w-10 h-8 flex items-center justify-center in-data-flux-sidebar-collapsed-desktop:opacity-0 in-data-flux-sidebar-collapsed-desktop:absolute in-data-flux-sidebar-collapsed-desktop:in-data-flux-sidebar-active:opacity-100" data-flux-sidebar-collapse>
                    <button type="button" class="size-10 relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none text-sm rounded-lg inline-flex bg-transparent hover:bg-white/[7%] text-gym-300 hover:text-white cursor-pointer">
                        <svg class="text-gym-300" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 3.75V16.25M3.4375 16.25H16.5625C17.08 16.25 17.5 15.83 17.5 15.3125V4.6875C17.5 4.17 17.08 3.75 16.5625 3.75H3.4375C2.92 3.75 2.5 4.17 2.5 4.6875V15.3125C2.5 15.83 2.92 16.25 3.4375 16.25Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </ui-sidebar-toggle>
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')" class="grid">
                    @auth
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    @endauth
                    <flux:sidebar.item icon="chat-bubble-left-right" :href="route('forums.index')" :current="request()->routeIs('forums.*')" wire:navigate>
                        {{ __('Forums') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="book-open" :href="route('blog.index')" :current="request()->routeIs('blog.*')" wire:navigate>
                        {{ __('Blog') }}
                    </flux:sidebar.item>
                    @auth
                    <flux:sidebar.item icon="envelope" :href="route('messages.index')" :current="request()->routeIs('messages.*')" wire:navigate>
                        {{ __('Messages') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="inbox" :href="route('mailbox.index')" :current="request()->routeIs('mailbox.*')" wire:navigate>
                        {{ __('Mailbox') }}
                    </flux:sidebar.item>
                    @endauth
                </flux:sidebar.group>

                @auth
                    @if(auth()->user()->isAdmin())
                    <flux:sidebar.group :heading="__('Admin')" class="grid">
                        <flux:sidebar.item icon="shield-check" :href="route('admin.dashboard')" :current="request()->routeIs('admin.*')" wire:navigate>
                            {{ __('Admin Panel') }}
                        </flux:sidebar.item>
                    </flux:sidebar.group>
                    @endif
                @endauth
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="globe-alt" href="{{ route('home') }}" wire:navigate>
                    {{ __('Website') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            @auth
                <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
            @else
                <div class="hidden lg:flex flex-col gap-1 p-2">
                    <flux:sidebar.item :href="route('login')" icon="arrow-right-start-on-rectangle" wire:navigate>
                        {{ __('Log in') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item :href="route('register')" icon="user-plus" wire:navigate>
                        {{ __('Register') }}
                    </flux:sidebar.item>
                </div>
            @endauth
        </flux:sidebar>

        <!-- Mobile User Menu -->
        @auth
        <flux:header class="lg:hidden bg-gym-900 border-b border-gym-700/50">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.settings')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
        @else
        <flux:header class="lg:hidden bg-gym-900 border-b border-gym-700/50">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:button :href="route('login')" variant="ghost" size="sm" class="text-gym-300 hover:text-white" wire:navigate>
                {{ __('Log in') }}
            </flux:button>
            <flux:button :href="route('register')" variant="primary" size="sm" class="bg-gradient-to-r from-orange-500 to-orange-600 border-0" wire:navigate>
                {{ __('Register') }}
            </flux:button>
        </flux:header>
        @endauth

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
