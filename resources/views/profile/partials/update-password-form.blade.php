<section>
    <header>
        <span class="eyebrow">{{ __('Security') }}</span>
        <h2 class="text-2xl font-semibold text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-3 text-sm leading-7 text-slate-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="field-label">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input-field" autocomplete="current-password" />
            @if($errors->updatePassword->has('current_password'))
                <p class="error-text">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="field-label">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="input-field" autocomplete="new-password" />
            @if($errors->updatePassword->has('password'))
                <p class="error-text">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="field-label">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-field" autocomplete="new-password" />
            @if($errors->updatePassword->has('password_confirmation'))
                <p class="error-text">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">{{ __('Update Password') }}</button>

            @if (session('status') === 'password-updated')
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
