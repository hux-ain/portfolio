@extends('admin.layouts.app')

@section('title', 'Messages')
@section('page-title', 'Contact Messages')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Received</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                    <tr class="{{ $msg->is_read ? '' : 'table-primary' }}">
                        <td>{{ $msg->id }}</td>
                        <td>
                            <strong>{{ $msg->name }}</strong>
                        </td>
                        <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                        <td>{{ Str::limit($msg->subject, 50) }}</td>
                        <td>{{ $msg->created_at->format('M d, Y h:i A') }}</td>
                        <td>
                            @if($msg->is_read)
                                <span class="badge bg-secondary">Read</span>
                            @else
                                <span class="badge bg-primary">Unread</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
