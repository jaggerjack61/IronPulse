<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gym-950 antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 relative overflow-hidden">
            <!-- Background image -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1920&auto=format&fit=crop" alt="" class="w-full h-full object-cover opacity-20">
                <div class="absolute inset-0 bg-gradient-to-t from-gym-950 via-gym-950/90 to-gym-950/70"></div>
            </div>

            <div class="relative z-10 flex w-full max-w-sm flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium mb-4" wire:navigate>
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-orange-500 to-lime-400 flex items-center justify-center shadow-lg shadow-orange-500/30">
                        <x-app-logo-icon class="size-8 text-white" />
                    </div>
                    <span class="font-display text-3xl text-white tracking-wider">IRONPULSE</span>
                </a>
                <div class="flex flex-col gap-6">
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
