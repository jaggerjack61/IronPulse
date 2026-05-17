<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'IronPulse') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 107, 43, 0.3); }
            50% { box-shadow: 0 0 40px rgba(255, 107, 43, 0.6); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }
        .animate-delay-4 { animation-delay: 0.4s; opacity: 0; }
        .gym-hero-bg {
            background-image: linear-gradient(rgba(250,250,248,0.88), rgba(250,250,248,0.72)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .dark .gym-hero-bg {
            background-image: linear-gradient(rgba(10,10,10,0.85), rgba(10,10,10,0.7)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1920&auto=format&fit=crop');
        }
    </style>
</head>
<body class="bg-gym-950 text-white min-h-screen font-sans antialiased">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gym-950/80 backdrop-blur-md border-b border-gym-700/50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group" wire:navigate>
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-500 to-lime-400 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 6.5h11M6.5 17.5h11M6 20v-4a2 2 0 0 1 4 0v4M14 20v-4a2 2 0 0 1 4 0v4M8 6V4a2 2 0 0 1 4 0v2M12 6V4a2 2 0 0 1 4 0v2"/>
                    </svg>
                </div>
                <span class="font-display text-2xl tracking-wider text-white">IRONPULSE</span>
            </a>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-5 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-colors" wire:navigate>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-gym-300 hover:text-white transition-colors" wire:navigate>
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 rounded-lg transition-all shadow-lg shadow-orange-500/20" wire:navigate>
                                Join Now
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gym-hero-bg min-h-screen flex items-center justify-center pt-20">
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <div class="animate-fade-in-up animate-delay-1">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-semibold tracking-widest uppercase text-lime-400 border border-lime-400/30 rounded-full bg-lime-400/10">
                    Your Fitness Community
                </span>
            </div>
            <h1 class="animate-fade-in-up animate-delay-2 font-display text-6xl md:text-8xl lg:text-9xl text-white mb-6 leading-none tracking-wide">
                FORGE YOUR<br><span class="gym-gradient-text">LEGACY</span>
            </h1>
            <p class="animate-fade-in-up animate-delay-3 text-lg md:text-xl text-gym-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Connect with athletes worldwide. Share workouts, track progress, and push your limits alongside a community that never quits.
            </p>
            <div class="animate-fade-in-up animate-delay-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 text-lg font-semibold text-neutral-950 bg-gradient-to-r from-orange-500 to-lime-400 rounded-xl hover:scale-105 transition-transform shadow-2xl shadow-orange-500/30" wire:navigate>
                    Start Your Journey
                </a>
                <a href="{{ route('forums.index') }}" class="px-8 py-4 text-lg font-semibold text-white border-2 border-gym-600 hover:border-orange-500 rounded-xl hover:bg-orange-500/10 transition-all" wire:navigate>
                    Explore Forums
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gym-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-display text-5xl md:text-6xl text-white mb-4">EVERYTHING YOU NEED</h2>
                <p class="text-gym-400 text-lg max-w-xl mx-auto">Tools built for serious athletes who take their training seriously.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Forums -->
                <a href="{{ route('forums.index') }}" class="group relative overflow-hidden rounded-2xl border border-gym-700 bg-gym-950 hover:border-orange-500/50 transition-all duration-300" wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gym-950/90 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=800&auto=format&fit=crop" alt="Training" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="relative z-20 p-8 -mt-12">
                        <div class="w-14 h-14 rounded-xl bg-orange-500 flex items-center justify-center mb-4 shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl text-white mb-2 tracking-wide">FORUMS</h3>
                        <p class="text-gym-400 text-sm leading-relaxed">Join intense discussions on programming, nutrition, recovery, and technique with passionate athletes.</p>
                    </div>
                </a>

                <!-- Blog -->
                <a href="{{ route('blog.index') }}" class="group relative overflow-hidden rounded-2xl border border-gym-700 bg-gym-950 hover:border-lime-400/50 transition-all duration-300" wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gym-950/90 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800&auto=format&fit=crop" alt="Weights" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="relative z-20 p-8 -mt-12">
                        <div class="w-14 h-14 rounded-xl bg-lime-400 flex items-center justify-center mb-4 shadow-lg shadow-lime-400/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-neutral-950" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl text-white mb-2 tracking-wide">EXPERT BLOG</h3>
                        <p class="text-gym-400 text-sm leading-relaxed">Science-backed articles from coaches, nutritionists, and elite athletes to level up your knowledge.</p>
                    </div>
                </a>

                <!-- Community -->
                <a href="{{ route('register') }}" class="group relative overflow-hidden rounded-2xl border border-gym-700 bg-gym-950 hover:border-orange-500/50 transition-all duration-300" wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gym-950/90 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1574680096145-d05b474e2155?q=80&w=800&auto=format&fit=crop" alt="Community" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="relative z-20 p-8 -mt-12">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-orange-500 to-lime-400 flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl text-white mb-2 tracking-wide">COMMUNITY</h3>
                        <p class="text-gym-400 text-sm leading-relaxed">Message members, build your crew, follow progress, and get real-time notifications on achievements.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="py-16 bg-gradient-to-r from-orange-500 to-orange-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="font-display text-4xl md:text-5xl text-white mb-1">10K+</div>
                    <div class="text-orange-100 text-sm font-medium uppercase tracking-wider">Athletes</div>
                </div>
                <div>
                    <div class="font-display text-4xl md:text-5xl text-white mb-1">500+</div>
                    <div class="text-orange-100 text-sm font-medium uppercase tracking-wider">Workouts</div>
                </div>
                <div>
                    <div class="font-display text-4xl md:text-5xl text-white mb-1">50K</div>
                    <div class="text-orange-100 text-sm font-medium uppercase tracking-wider">Posts</div>
                </div>
                <div>
                    <div class="font-display text-4xl md:text-5xl text-white mb-1">24/7</div>
                    <div class="text-orange-100 text-sm font-medium uppercase tracking-wider">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gym-950 relative">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="font-display text-5xl md:text-6xl text-white mb-6">READY TO <span class="gym-gradient-text">TRANSFORM?</span></h2>
            <p class="text-gym-400 text-lg mb-10 max-w-xl mx-auto">Join thousands of athletes who are already pushing their limits. Your transformation starts with a single rep.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-10 py-5 text-lg font-bold text-neutral-950 bg-gradient-to-r from-orange-500 to-lime-400 rounded-2xl hover:scale-105 transition-transform shadow-2xl shadow-orange-500/30" wire:navigate>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 6.5h11M6.5 17.5h11M6 20v-4a2 2 0 0 1 4 0v4M14 20v-4a2 2 0 0 1 4 0v4M8 6V4a2 2 0 0 1 4 0v2M12 6V4a2 2 0 0 1 4 0v2"/>
                </svg>
                JOIN IRONPULSE FREE
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gym-900 border-t border-gym-700/50 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-md bg-gradient-to-br from-orange-500 to-lime-400 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 6.5h11M6.5 17.5h11M6 20v-4a2 2 0 0 1 4 0v4M14 20v-4a2 2 0 0 1 4 0v4M8 6V4a2 2 0 0 1 4 0v2M12 6V4a2 2 0 0 1 4 0v2"/>
                    </svg>
                </div>
                <span class="font-display text-xl text-white tracking-wider">IRONPULSE</span>
            </div>
            <div class="flex items-center gap-6 text-sm text-gym-400">
                <a href="{{ route('forums.index') }}" class="hover:text-orange-400 transition-colors">Forums</a>
                <a href="{{ route('blog.index') }}" class="hover:text-orange-400 transition-colors">Blog</a>
                <a href="{{ route('login') }}" class="hover:text-orange-400 transition-colors">Log In</a>
            </div>
            <div class="text-sm text-gym-500">
                &copy; {{ date('Y') }} IronPulse. All rights reserved.
            </div>
        </div>
    </footer>

    @fluxScripts
</body>
</html>
