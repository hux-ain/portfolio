@extends('auth.layouts.app')

@section('title', 'Verify Email')

@section('header-text', 'Verify Your Email')

@section('content')
<div class="mb-4 text-muted-custom small">
    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
</div>

@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success mb-3">
        {{ __('A new verification link has been sent to your email address.') }}
    </div>
@endif

<div class="d-flex justify-content-between mt-4">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-envelope me-2"></i>Resend Verification Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-light">
            <i class="fas fa-sign-out-alt me-2"></i>Log Out
        </button>
    </form>
</div>
@endsection

@section('footer')
    Need to change email? <a href="{{ route('verification.send') }}">Request new link</a>
@endsection
