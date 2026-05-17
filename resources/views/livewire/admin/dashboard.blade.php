<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:heading size="sm" class="text-gym-400">{{ __('Users') }}</flux:heading>
            <flux:heading size="2xl" class="text-orange-500">{{ $stats['users'] }}</flux:heading>
        </flux:card>
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:heading size="sm" class="text-gym-400">{{ __('Forum Posts') }}</flux:heading>
            <flux:heading size="2xl" class="text-lime-400">{{ $stats['posts'] }}</flux:heading>
        </flux:card>
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:heading size="sm" class="text-gym-400">{{ __('Blog Posts') }}</flux:heading>
            <flux:heading size="2xl" class="text-orange-500">{{ $stats['blog_posts'] }}</flux:heading>
        </flux:card>
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:heading size="sm" class="text-gym-400">{{ __('Categories') }}</flux:heading>
            <flux:heading size="2xl" class="text-lime-400">{{ $stats['categories'] }}</flux:heading>
        </flux:card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Quick Actions') }}</flux:heading>
            <div class="space-y-2">
                <flux:button :href="route('admin.blog.create')" variant="outline" class="w-full justify-start border-gym-600 text-gym-300 hover:border-orange-500 hover:text-orange-400" wire:navigate>
                    {{ __('Create Blog Post') }}
                </flux:button>
                <flux:button :href="route('admin.mailbox.send')" variant="outline" class="w-full justify-start border-gym-600 text-gym-300 hover:border-orange-500 hover:text-orange-400" wire:navigate>
                    {{ __('Send Mailbox Message') }}
                </flux:button>
                <flux:button :href="route('admin.forums.index')" variant="outline" class="w-full justify-start border-gym-600 text-gym-300 hover:border-orange-500 hover:text-orange-400" wire:navigate>
                    {{ __('Manage Forum Categories') }}
                </flux:button>
            </div>
        </flux:card>

        <flux:card class="bg-gym-900 border-gym-700/50">
            <flux:heading size="lg" class="mb-4 text-white font-display tracking-wide">{{ __('Latest Users') }}</flux:heading>
            <div class="space-y-3">
                @foreach($latestUsers as $user)
                <div class="flex items-center gap-3">
                    <flux:avatar :name="$user->name" :initials="$user->initials()" />
                    <div>
                        <flux:text class="font-medium text-white">{{ $user->name }}</flux:text>
                        <flux:text class="text-sm text-gym-400">{{ $user->email }}</flux:text>
                    </div>
                </div>
                @endforeach
            </div>
        </flux:card>
    </div>
</div>
