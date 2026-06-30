@extends('layouts.frontend')

@section('title', 'Contact | Hux_Ain')

@section('content')
<section class="section-shell">
    <div class="site-shell grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="surface-card p-6 sm:p-8">
            <span class="eyebrow">Contact</span>
            <h1 class="section-title">Let's talk about the product you want to build.</h1>
            <p class="section-copy">Agar aapko portfolio, admin panel, internal dashboard, ya Laravel backend chahiye ho to details share karein.</p>

            <div class="mt-8 space-y-4 text-sm text-slate-300">
                <div class="subtle-card p-4">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Phone</p>
                    <a href="tel:03341022301" class="mt-2 block text-white">03341022301</a>
                </div>
                <div class="subtle-card p-4">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Email</p>
                    <a href="mailto:hussain@example.com" class="mt-2 block text-white">hussain@example.com</a>
                </div>
                <div class="subtle-card p-4">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Location</p>
                    <p class="mt-2 text-white">Karachi, Pakistan</p>
                </div>
            </div>
        </div>

        <div class="surface-card p-6 sm:p-8">
            <div class="panel-header">
                <div>
                    <h2 class="page-title">Send a Message</h2>
                    <p class="page-copy">Clear brief bhejein, main jaldi reply karunga.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-300/20 bg-emerald-300/10 px-4 py-3 text-sm text-emerald-100">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="field-label" for="name">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="input-field @error('name') border-rose-300/40 @enderror" required>
                        @error('name')<p class="error-text">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="input-field @error('email') border-rose-300/40 @enderror" required>
                        @error('email')<p class="error-text">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="field-label" for="subject">Subject</label>
                    <input id="subject" type="text" name="subject" value="{{ old('subject') }}" class="input-field @error('subject') border-rose-300/40 @enderror" required>
                    @error('subject')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="field-label" for="message">Message</label>
                    <textarea id="message" name="message" rows="6" class="textarea-field @error('message') border-rose-300/40 @enderror" required>{{ old('message') }}</textarea>
                    @error('message')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-primary w-full sm:w-auto">Send Message</button>
            </form>
        </div>
    </div>
</section>
@endsection
