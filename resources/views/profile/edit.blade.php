<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ __('Account Settings') }}</p>
            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-white">
                {{ __('Profile') }}
            </h2>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-400">
                {{ __('Update your identity, strengthen security, and manage account access from one clean workspace.') }}
            </p>
        </div>
    </x-slot>

    <div class="section-shell">
        <div class="site-shell space-y-6">
            <div class="surface-card p-6 sm:p-8">
                <div class="max-w-3xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="surface-card p-6 sm:p-8">
                <div class="max-w-3xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="surface-card p-6 sm:p-8">
                <div class="max-w-3xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
