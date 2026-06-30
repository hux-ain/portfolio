<nav class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/85 backdrop-blur">
    <div class="site-shell">
        <div class="flex items-center justify-between py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-white">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-100 ring-1 ring-cyan-300/20">
                    <i class="fa-solid fa-user-gear"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-200">Account</p>
                    <p class="text-xs text-slate-400">Profile Workspace</p>
                </div>
            </a>

            @php
                $navLink = 'rounded-full px-4 py-2 text-sm font-medium transition';
                $navActive = 'bg-white/10 text-white';
                $navIdle = 'text-slate-300 hover:bg-white/5 hover:text-white';
            @endphp

            <div class="hidden items-center gap-2 lg:flex">
                <a href="{{ route('dashboard') }}" class="{{ $navLink }} {{ request()->routeIs('dashboard') ? $navActive : $navIdle }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="{{ $navLink }} {{ request()->routeIs('profile.edit') ? $navActive : $navIdle }}">Profile</a>
                @if(auth()->user()?->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="{{ $navLink }} {{ request()->routeIs('admin.*') ? $navActive : $navIdle }}">Admin</a>
                @endif
            </div>

            <div class="hidden items-center gap-3 lg:flex">
                <div class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-300">
                    {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary !py-2.5">Logout</button>
                </form>
            </div>

            <button type="button" data-mobile-toggle class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 lg:hidden">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div data-mobile-menu class="hidden border-t border-white/10 pb-4 pt-4 lg:hidden">
            <div class="flex flex-col gap-2">
                <a href="{{ route('dashboard') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('profile.edit') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Profile</a>
                @if(auth()->user()?->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="rounded-2xl px-4 py-3 text-sm {{ request()->routeIs('admin.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Admin</a>
                @endif
                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-300">
                    {{ Auth::user()->name }}<br>
                    <span class="text-xs text-slate-500">{{ Auth::user()->email }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary w-full">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
