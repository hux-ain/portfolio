<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ __('Workspace') }}</p>
            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-white">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-400">
                {{ __('A clean overview of your account, portfolio access, and quick actions.') }}
            </p>
        </div>
    </x-slot>

    <div class="section-shell">
        <div class="site-shell">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="stat-card">
                    <p class="stat-label">{{ __('Account Status') }}</p>
                    <p class="stat-number">{{ __('Active') }}</p>
                    <p class="mt-3 text-sm leading-7 text-slate-400">
                        {{ __("You're logged in and your workspace is ready.") }}
                    </p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">{{ __('Primary Email') }}</p>
                    <p class="mt-3 text-lg font-semibold text-white">{{ auth()->user()->email }}</p>
                    <p class="mt-3 text-sm leading-7 text-slate-400">
                        {{ __('Use this email for password resets, verification, and notifications.') }}
                    </p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">{{ __('Role Access') }}</p>
                    <p class="stat-number">{{ auth()->user()->is_admin ? __('Admin') : __('User') }}</p>
                    <p class="mt-3 text-sm leading-7 text-slate-400">
                        {{ auth()->user()->is_admin ? __('You can also access portfolio management tools.') : __('You have secure access to your personal account area.') }}
                    </p>
                </div>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                <section class="surface-card p-6 sm:p-8">
                    <span class="eyebrow">{{ __('Quick Actions') }}</span>
                    <h3 class="text-2xl font-semibold text-white">{{ __('Manage your account without digging through menus.') }}</h3>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-400">
                        {{ __('Update personal details, secure your password, or move into the admin side if your account has elevated access.') }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('profile.edit') }}" class="btn-primary">{{ __('Edit Profile') }}</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="btn-secondary">{{ __('Open Admin Panel') }}</a>
                        @endif
                        <a href="{{ url('/') }}" class="btn-secondary">{{ __('View Portfolio') }}</a>
                    </div>
                </section>

                <section class="surface-card p-6 sm:p-8">
                    <span class="eyebrow">{{ __('Security') }}</span>
                    <h3 class="text-2xl font-semibold text-white">{{ __('Stay in control of your account.') }}</h3>
                    <div class="mt-6 space-y-4">
                        <div class="subtle-card p-4">
                            <p class="text-sm font-medium text-white">{{ __('Password hygiene') }}</p>
                            <p class="mt-2 text-sm leading-7 text-slate-400">{{ __('Use a long password and update it regularly from the profile screen.') }}</p>
                        </div>
                        <div class="subtle-card p-4">
                            <p class="text-sm font-medium text-white">{{ __('Profile details') }}</p>
                            <p class="mt-2 text-sm leading-7 text-slate-400">{{ __('Keep your name and email accurate for account recovery and notifications.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
