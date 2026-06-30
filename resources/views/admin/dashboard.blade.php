@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['total_projects'] }}</h3>
                        <small>Total Projects</small>
                    </div>
                    <i class="fas fa-code fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['total_skills'] }}</h3>
                        <small>Skills</small>
                    </div>
                    <i class="fas fa-tools fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['total_experiences'] }}</h3>
                        <small>Experiences</small>
                    </div>
                    <i class="fas fa-briefcase fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['unread_messages'] }}</h3>
                        <small>Unread Messages</small>
                    </div>
                    <i class="fas fa-envelope fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="row">
    <!-- Recent Projects -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Projects</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentProjects->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentProjects as $project)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $project->title }}</strong><br>
                                    <small class="text-muted">{{ $project->tech_stack ? implode(', ', $project->tech_stack) : 'No tech stack' }}</small>
                                </div>
                                <span class="badge bg-{{ $project->is_active ? 'success' : 'secondary' }}">
                                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No projects yet. <a href="{{ route('admin.projects.create') }}">Add your first project</a>!</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Messages</h5>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentMessages->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentMessages as $message)
                            <a href="{{ route('admin.messages.show', $message) }}" class="list-group-item list-group-item-action {{ $message->is_read ? '' : 'list-group-item-primary' }}">
                                <div class="d-flex w-100 justify-content-between">
                                    <strong>{{ $message->name }}</strong>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">{{ Str::limit($message->subject, 50) }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No messages yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
