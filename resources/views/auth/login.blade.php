@extends('auth.layouts.app')

@section('title', 'Login')

@section('header-text', 'Sign in to your account')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="current-password" placeholder="Enter your password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">Remember me</label>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-sign-in-alt me-2"></i>Sign In
    </button>

    <!-- Forgot Password -->
    @if (Route::has('password.request'))
        <div class="text-center mt-3">
            <a class="btn btn-link text-muted-custom" href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        </div>
    @endif
</form>
@endsection

@section('footer')
    Don't have an account? <a href="{{ route('register') }}">Register here</a>
@endsection
