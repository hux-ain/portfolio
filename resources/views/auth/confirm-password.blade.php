@extends('auth.layouts.app')

@section('title', 'Confirm Password')

@section('header-text', 'Confirm Password')

@section('content')
<div class="mb-4 text-muted-custom small">
    {{ __('This is a secure area. Please confirm your password before continuing.') }}
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="current-password" placeholder="Enter your password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-shield-alt me-2"></i>Confirm
    </button>
</form>
@endsection

@section('footer')
    For security purposes, please confirm your password.
@endsection
