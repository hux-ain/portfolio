@extends('admin.layouts.app')

@section('title', 'Message')
@section('page-title', 'View Message')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Message Details</h5>
                    @if(!$message->is_read)
                        <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-check"></i> Mark as Read
                            </button>
                        </form>
                    @else
                        <span class="badge bg-secondary">Read</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>From:</strong> {{ $message->name }} ({{ $message->email }})
                </div>
                <div class="mb-3">
                    <strong>Date:</strong> {{ $message->created_at->format('F d, Y h:i A') }}
                </div>
                <div class="mb-3">
                    <strong>Subject:</strong> {{ $message->subject }}
                </div>
                <hr>
                <div class="mb-3">
                    <h6>Message:</h6>
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>

                <div class="mt-4">
                    <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Back to Messages</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
