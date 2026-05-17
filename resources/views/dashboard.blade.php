<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Welcome Banner -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-gym-900 to-gym-800 border border-gym-700/50 p-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
            <div class="relative z-10">
                <h1 class="font-display text-4xl text-white mb-2 tracking-wide">WELCOME BACK, <span class="text-orange-500">{{ auth()->user()->name }}</span></h1>
                <p class="text-gym-400">Ready to crush today's goals? Check out the latest from your community.</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-gym-700/50 bg-gym-900 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-lime-400 bg-lime-400/10 px-2 py-1 rounded-full">+12%</span>
                </div>
                <div class="font-display text-3xl text-white">24</div>
                <div class="text-sm text-gym-400 mt-1">Workouts This Month</div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-gym-700/50 bg-gym-900 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-lime-400/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-1.53 0-3.07.074-4.607.22-1.584.233-2.707 1.626-2.707 3.228v6.741z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-lime-400 bg-lime-400/10 px-2 py-1 rounded-full">+5</span>
                </div>
                <div class="font-display text-3xl text-white">156</div>
                <div class="text-sm text-gym-400 mt-1">Forum Contributions</div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-gym-700/50 bg-gym-900 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.954-3.11M15 19.128V13.5a2.25 2.25 0 012.25-2.25h1.5c.621 0 1.125.504 1.125 1.125v.659M15 19.128l-2.25-1.125M15 19.128l2.25-1.125M15 13.5l-2.25-1.125M15 13.5l2.25-1.125"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gym-400 bg-gym-700/50 px-2 py-1 rounded-full">Streak</span>
                </div>
                <div class="font-display text-3xl text-white">7 Days</div>
                <div class="text-sm text-gym-400 mt-1">Active Login Streak</div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2 relative overflow-hidden rounded-xl border border-gym-700/50 bg-gym-900 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-display text-2xl text-white tracking-wide">RECENT ACTIVITY</h2>
                    <a href="{{ route('forums.index') }}" class="text-sm text-orange-500 hover:text-orange-400 transition-colors" wire:navigate>View All &rarr;</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 rounded-lg bg-gym-950 border border-gym-800">
                        <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 016.75 21a5.972 5.972 0 01-1.62-2.337A9.764 9.764 0 012.55 18.5C2.03 18.17 1.58 17.74 1.21 17.25A8.252 8.252 0 010 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-medium">New post in <span class="text-orange-400">Strength Training</span></p>
                            <p class="text-sm text-gym-400 mt-1">"Best deadlift accessories for breaking plateaus" by Mike T.</p>
                            <p class="text-xs text-gym-500 mt-2">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-lg bg-gym-950 border border-gym-800">
                        <div class="w-10 h-10 rounded-full bg-lime-400/20 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-medium">New blog article published</p>
                            <p class="text-sm text-gym-400 mt-1">"The Science of Progressive Overload Explained"</p>
                            <p class="text-xs text-gym-500 mt-2">5 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-lg bg-gym-950 border border-gym-800">
                        <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-medium">Sarah K. liked your forum reply</p>
                            <p class="text-sm text-gym-400 mt-1">In "Nutrition for Hypertrophy"</p>
                            <p class="text-xs text-gym-500 mt-2">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="relative overflow-hidden rounded-xl border border-gym-700/50 bg-gym-900 p-6">
                <h2 class="font-display text-2xl text-white mb-6 tracking-wide">QUICK LINKS</h2>
                <div class="space-y-3">
                    <a href="{{ route('forums.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gym-950 border border-gym-800 hover:border-orange-500/50 transition-all group" wire:navigate>
                        <div class="w-8 h-8 rounded-md bg-orange-500/20 flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                            <svg class="w-4 h-4 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium text-sm">Browse Forums</div>
                            <div class="text-xs text-gym-500">Join the conversation</div>
                        </div>
                    </a>
                    <a href="{{ route('blog.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gym-950 border border-gym-800 hover:border-lime-400/50 transition-all group" wire:navigate>
                        <div class="w-8 h-8 rounded-md bg-lime-400/20 flex items-center justify-center group-hover:bg-lime-400 transition-colors">
                            <svg class="w-4 h-4 text-lime-400 group-hover:text-neutral-950 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium text-sm">Read Blog</div>
                            <div class="text-xs text-gym-500">Expert articles</div>
                        </div>
                    </a>
                    <a href="{{ route('messages.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gym-950 border border-gym-800 hover:border-orange-500/50 transition-all group" wire:navigate>
                        <div class="w-8 h-8 rounded-md bg-orange-500/20 flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                            <svg class="w-4 h-4 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium text-sm">Messages</div>
                            <div class="text-xs text-gym-500">Chat with members</div>
                        </div>
                    </a>
                    <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gym-950 border border-gym-800 hover:border-lime-400/50 transition-all group" wire:navigate>
                        <div class="w-8 h-8 rounded-md bg-lime-400/20 flex items-center justify-center group-hover:bg-lime-400 transition-colors">
                            <svg class="w-4 h-4 text-lime-400 group-hover:text-neutral-950 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.27 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium text-sm">Settings</div>
                            <div class="text-xs text-gym-500">Manage your account</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
