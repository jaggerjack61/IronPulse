@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <flux:heading size="xl" class="text-white font-display tracking-wide">{{ $title }}</flux:heading>
    <flux:subheading class="text-gym-400">{{ $description }}</flux:subheading>
</div>
