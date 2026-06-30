<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Portfolio') }} | @yield('title', 'Authentication') </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="auth-shell">
    <div class="site-shell flex min-h-screen items-center py-10">
        <div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="hidden rounded-[2rem] border border-white/10 bg-white/5 p-10 lg:block">
                <span class="eyebrow">Secure Access</span>
                <h1 class="mt-4 text-4xl font-semibold tracking-tight text-white">Manage your portfolio with a cleaner and calmer admin experience.</h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-slate-300">Login, register aur password flows ko lightweight, premium aur distraction-free experience ke sath redesign kiya gaya hai.</p>
                <div class="mt-10 grid gap-4">
                    <div class="subtle-card p-5">
                        <p class="text-sm font-medium text-white">Focused access</p>
                        <p class="mt-2 text-sm leading-7 text-slate-400">Minimal UI jo form completion ko easy aur fast banata hai.</p>
                    </div>
                    <div class="subtle-card p-5">
                        <p class="text-sm font-medium text-white">Consistent system</p>
                        <p class="mt-2 text-sm leading-7 text-slate-400">Public site, auth screens aur admin interface ab same visual direction follow karte hain.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <div class="auth-card">
                    <a href="{{ url('/') }}" class="mb-8 inline-flex items-center gap-3 text-white">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-100 ring-1 ring-cyan-300/20">
                            <i class="fa-solid fa-code"></i>
                        </span>
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-200">Hux_Ain</p>
                            <p class="text-xs text-slate-400">Portfolio Access</p>
                        </div>
                    </a>

                    <h1 class="text-3xl font-semibold text-white">@yield('title', 'Sign In')</h1>
                    <p class="mt-3 text-sm leading-7 text-slate-400">@yield('header-text', 'Welcome back.')</p>

                    @if(session('status'))
                        <div class="mt-6 rounded-2xl border border-emerald-300/20 bg-emerald-300/10 px-4 py-3 text-sm text-emerald-100">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mt-8">
                        @yield('content')
                    </div>

                    <div class="mt-8 border-t border-white/10 pt-6 text-sm text-slate-400">
                        @yield('footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('scripts')
</body>
</html>
