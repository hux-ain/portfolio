<section class="space-y-6">
    <header>
        <span class="eyebrow">{{ __('Danger Zone') }}</span>
        <h2 class="text-2xl font-semibold text-white">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-3 text-sm leading-7 text-slate-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger"
    >
        <i class="fa-solid fa-trash"></i>
        {{ __('Delete Account') }}
    </button>

    <div x-data="{ open: false }" x-on:open-modal.window="if ($event.detail.name === 'confirm-user-deletion') open = true" x-on:close-modal.window="if ($event.detail.name === 'confirm-user-deletion') open = false" x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm"></div>
        
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="surface-card w-full max-w-lg p-8 relative z-10">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-2xl font-semibold text-white">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="field-label sr-only">{{ __('Password') }}</label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="input-field"
                        placeholder="{{ __('Enter your password') }}"
                    />

                    @if($errors->userDeletion->has('password'))
                        <p class="error-text">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <button type="button" x-on:click="$dispatch('close-modal', { name: 'confirm-user-deletion' })" class="btn-secondary">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="btn-danger">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
