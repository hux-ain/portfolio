@extends('auth.layouts.app')

@section('title', 'Register')

@section('header-text', 'Create new account')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
               name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="new-password" placeholder="Enter password (min. 8 characters)">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control"
               name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus me-2"></i>Create Account
    </button>

    <!-- Already Registered -->
    <div class="text-center mt-3">
        <a class="btn btn-link text-muted-custom" href="{{ route('login') }}">
            Already have an account? Login here
        </a>
    </div>
</form>
@endsection

@section('footer')
    Protected by Laravel Security
@endsection
