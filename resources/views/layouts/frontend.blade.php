<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Portfolio of Muhammad-ul-Hussain (Hux_Ain) - Full-Stack Laravel Developer">
    <title>@yield('title', 'Hux_Ain | Full-Stack Laravel Developer')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="relative isolate overflow-hidden">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-cyan-300/40 to-transparent"></div>

        <header class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/85 backdrop-blur">
            <div class="site-shell">
                <div class="flex items-center justify-between py-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 text-white">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-300/20">
                            <i class="fa-solid fa-code"></i>
                        </span>
                        <div>
                            <p class="text-sm font-semibold tracking-[0.2em] text-cyan-200 uppercase">Hux_Ain</p>
                            <p class="text-xs text-slate-400">Laravel Developer</p>
                        </div>
                    </a>

                    <nav class="hidden items-center gap-2 lg:flex">
                        @php
                            $navLink = 'rounded-full px-4 py-2 text-sm font-medium transition';
                            $navActive = 'bg-white/10 text-white';
                            $navIdle = 'text-slate-300 hover:bg-white/5 hover:text-white';
                        @endphp
                        <a href="{{ route('home') }}" class="{{ $navLink }} {{ request()->routeIs('home') ? $navActive : $navIdle }}">Home</a>
                        <a href="{{ route('projects') }}" class="{{ $navLink }} {{ request()->routeIs('projects') ? $navActive : $navIdle }}">Projects</a>
                        <a href="{{ route('skills') }}" class="{{ $navLink }} {{ request()->routeIs('skills') ? $navActive : $navIdle }}">Skills</a>
                        <a href="{{ route('experience') }}" class="{{ $navLink }} {{ request()->routeIs('experience') ? $navActive : $navIdle }}">Experience</a>
                        <a href="{{ route('contact') }}" class="{{ $navLink }} {{ request()->routeIs('contact') ? $navActive : $navIdle }}">Contact</a>
                    </nav>

                    <div class="hidden items-center gap-3 lg:flex">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="btn-secondary !py-2.5">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-secondary !py-2.5">Login</a>
                        @endauth
                        <a href="{{ route('contact') }}" class="btn-primary !py-2.5">Let's Talk</a>
                    </div>

                    <button type="button" data-mobile-toggle class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 lg:hidden">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>

                <div data-mobile-menu class="hidden border-t border-white/10 pb-4 pt-4 lg:hidden">
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('home') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('home') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Home</a>
                        <a href="{{ route('projects') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('projects') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Projects</a>
                        <a href="{{ route('skills') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('skills') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Skills</a>
                        <a href="{{ route('experience') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('experience') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Experience</a>
                        <a href="{{ route('contact') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('contact') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Contact</a>
                        <div class="mt-3 flex flex-col gap-2">
                            @auth
                                <a href="{{ route('admin.dashboard') }}" class="btn-secondary w-full">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary w-full">Login</a>
                            @endauth
                            <a href="{{ route('contact') }}" class="btn-primary w-full">Let's Talk</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="border-t border-white/10 bg-slate-950/80">
            <div class="site-shell py-10">
                <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-300/20">
                                <i class="fa-solid fa-code"></i>
                            </span>
                            <div>
                                <p class="text-lg font-semibold text-white">Muhammad-ul-Hussain</p>
                                <p class="text-sm text-slate-400">Building clean products with Laravel, APIs and thoughtful UX.</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-8 sm:grid-cols-2">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Explore</p>
                            <div class="mt-4 flex flex-col gap-3 text-sm text-slate-300">
                                <a href="{{ route('projects') }}">Projects</a>
                                <a href="{{ route('skills') }}">Skills</a>
                                <a href="{{ route('experience') }}">Experience</a>
                                <a href="{{ route('contact') }}">Contact</a>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Connect</p>
                            <div class="mt-4 flex flex-col gap-3 text-sm text-slate-300">
                                <a href="tel:03341022301">03341022301</a>
                                <a href="mailto:hussain@example.com">hussain@example.com</a>
                                <a href="https://github.com/Hux_Ain" target="_blank">GitHub</a>
                                <a href="https://linkedin.com/in/hux-ain" target="_blank">LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex flex-col gap-3 border-t border-white/10 pt-6 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p>&copy; {{ date('Y') }} Hux_Ain. All rights reserved.</p>
                    <p>Designed with a cleaner modern minimal system.</p>
                </div>
            </div>
        </footer>
    </div>

    <button type="button" data-chatbot-toggle class="fixed bottom-6 right-4 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-cyan-400 text-slate-950 shadow-2xl shadow-cyan-500/20 transition hover:scale-105">
        <i class="fa-solid fa-comment-dots"></i>
    </button>

    <div data-chatbot-panel class="chatbot-panel">
        <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
            <div>
                <p class="text-sm font-semibold text-white">Quick Assistant</p>
                <p class="text-xs text-slate-400">Projects, skills aur availability puch sakte hain</p>
            </div>
            <button type="button" data-chatbot-toggle class="text-slate-400 hover:text-white">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div data-chatbot-body class="flex max-h-80 flex-col gap-3 overflow-y-auto px-5 py-4">
            <div class="chat-bubble-bot">Salam! Main Hux_Ain ke portfolio assistant ki tarah projects, skills aur availability ke bare mein help kar sakta hoon.</div>
        </div>
        <form data-chatbot-form data-endpoint="{{ route('chatbot.ask') }}" class="border-t border-white/10 p-4">
            <div class="flex gap-3">
                <input data-chatbot-input type="text" class="input-field" placeholder="Ask anything..." required>
                <button type="submit" class="btn-primary !rounded-2xl !px-4">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>

    @stack('scripts')
</body>
</html>
