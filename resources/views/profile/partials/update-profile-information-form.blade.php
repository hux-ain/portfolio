<section>
    <header>
        <span class="eyebrow">{{ __('Identity') }}</span>
        <h2 class="text-2xl font-semibold text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-3 text-sm leading-7 text-slate-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="field-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="input-field" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="field-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="input-field" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="error-text">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-2xl border border-amber-300/20 bg-amber-300/10 p-4">
                    <p class="text-sm text-amber-100">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="ml-1 underline decoration-cyan-300/40 underline-offset-4 transition hover:text-white focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 text-sm font-medium text-emerald-200">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-200"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
