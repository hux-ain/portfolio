@extends('auth.layouts.app')

@section('title', 'Reset Password')

@section('header-text', 'Set New Password')

@section('content')
<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="Enter your email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="new-password" placeholder="Enter new password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input id="password_confirmation" type="password" class="form-control"
               name="password_confirmation" required autocomplete="new-password" placeholder="Confirm new password">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-key me-2"></i>Reset Password
    </button>
</form>
@endsection

@section('footer')
    Remembered your password? <a href="{{ route('login') }}">Back to login</a>
@endsection
