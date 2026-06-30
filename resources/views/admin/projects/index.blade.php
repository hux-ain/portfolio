@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Manage Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Project
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Tech Stack</th>
                        <th>Featured</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>
                            <strong>{{ $project->title }}</strong><br>
                            <small class="text-muted">{{ Str::limit($project->description, 80) }}</small>
                        </td>
                        <td>
                            @if($project->tech_stack)
                                @foreach($project->tech_stack as $t)
                                    <span class="badge bg-secondary me-1 mb-1">{{ $t }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($project->is_featured)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        </td>
                        <td>{{ $project->order_number }}</td>
                        <td>
                            <span class="badge bg-{{ $project->is_active ? 'success' : 'secondary' }}">
                                {{ $project->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
