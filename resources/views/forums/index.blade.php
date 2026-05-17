<x-layouts::app>
    <div>
        <div class="max-w-7xl mx-auto">
            <!-- Hero Banner -->
            <div class="relative overflow-hidden rounded-2xl mb-8 bg-gradient-to-r from-gym-900 to-gym-800 border border-gym-700/50">
                <div class="absolute inset-0 opacity-20">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1200&auto=format&fit=crop" alt="" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-gym-950/90 to-gym-950/50"></div>
                <div class="relative z-10 p-8 md:p-12">
                    <h1 class="font-display text-4xl md:text-5xl text-white mb-3 tracking-wide">FORUMS</h1>
                    <p class="text-gym-400 max-w-xl">Join the conversation. Share knowledge, ask questions, and connect with athletes who speak your language.</p>
                </div>
            </div>

            <livewire:forum.index />
        </div>
    </div>
</x-layouts::app>
