<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gym-950 antialiased">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <!-- Left side - Image panel -->
            <div class="relative hidden h-full flex-col p-10 text-white lg:flex">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=1920&auto=format&fit=crop" alt="Athlete" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-gym-950/90 to-gym-950/40"></div>
                </div>

                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3 font-medium" wire:navigate>
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-500 to-lime-400 flex items-center justify-center">
                        <x-app-logo-icon class="size-6 text-white" />
                    </div>
                    <span class="font-display text-2xl tracking-wider">IRONPULSE</span>
                </a>

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg" class="font-display text-3xl tracking-wide">&ldquo;The only bad workout is the one that didn't happen.&rdquo;</flux:heading>
                        <footer><flux:heading class="text-orange-400">IronPulse Community</flux:heading></footer>
                    </blockquote>
                </div>
            </div>

            <!-- Right side - Form -->
            <div class="w-full lg:p-8 relative z-10">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-lime-400 flex items-center justify-center">
                            <x-app-logo-icon class="size-7 text-white" />
                        </div>
                        <span class="font-display text-2xl text-white tracking-wider">IRONPULSE</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
