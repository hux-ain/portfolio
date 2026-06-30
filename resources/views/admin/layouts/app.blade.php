<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | Hux_Ain</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="min-h-screen lg:grid lg:grid-cols-[18rem_1fr]">
        <aside data-sidebar class="border-b border-white/10 bg-slate-950/95 px-4 py-6 lg:block lg:border-b-0 lg:border-r">
            <a href="{{ route('admin.dashboard') }}" class="mb-8 flex items-center gap-3 px-2 text-white">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-100 ring-1 ring-cyan-300/20">
                    <i class="fa-solid fa-layer-group"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-200">Admin</p>
                    <p class="text-xs text-slate-400">Portfolio Control</p>
                </div>
            </a>

            @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-chart-line w-4"></i> Dashboard</a>
                <a href="{{ route('admin.projects.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"><i class="fa-solid fa-code-branch w-4"></i> Projects</a>
                <a href="{{ route('admin.skills.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}"><i class="fa-solid fa-screwdriver-wrench w-4"></i> Skills</a>
                <a href="{{ route('admin.experiences.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}"><i class="fa-solid fa-briefcase w-4"></i> Experience</a>
                <a href="{{ route('admin.messages.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="fa-solid fa-envelope w-4"></i> Messages @if($unread > 0)<span class="ml-auto badge-accent">{{ $unread }}</span>@endif</a>
            </nav>

            <div class="mt-8 space-y-3 border-t border-white/10 pt-6">
                <a href="{{ url('/') }}" target="_blank" class="btn-secondary w-full">View Site</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-danger w-full">Logout</button>
                </form>
            </div>
        </aside>

        <div>
            <header class="border-b border-white/10 bg-slate-950/80 backdrop-blur">
                <div class="site-shell flex items-center justify-between py-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Portfolio Admin</p>
                        <h1 class="mt-1 text-2xl font-semibold text-white">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="hidden rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-300 sm:inline-flex">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <button type="button" data-sidebar-toggle class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 lg:hidden">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>
                </div>
            </header>

            <main class="site-shell py-8">
                @if(session('success'))
                    <div class="alert alert-success mb-6">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mb-6">{{ session('error') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
