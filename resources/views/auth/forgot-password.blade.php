@extends('auth.layouts.app')

@section('title', 'Forgot Password')

@section('header-text', 'Reset Password')

@section('content')
<div class="mb-4 text-muted-custom small">
    {{ __('Forgot your password? No problem. Just enter your email address and we will send you a password reset link.') }}
</div>

@if (session('status'))
    <div class="alert alert-success mb-3">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your registered email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
    </button>
</form>
@endsection

@section('footer')
    Remembered your password? <a href="{{ route('login') }}">Back to login</a>
@endsection
