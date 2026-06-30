@extends('admin.layouts.app')

@section('title', 'Skills')
@section('page-title', 'Manage Skills')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.skills.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Skill
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Skill</th>
                        <th>Category</th>
                        <th>Proficiency</th>
                        <th>Icon</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                    <tr>
                        <td>{{ $skill->id }}</td>
                        <td>
                            <strong>{{ $skill->name }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-{{ $skill->category == 'backend' ? 'primary' : ($skill->category == 'frontend' ? 'success' : ($skill->category == 'devops' ? 'warning' : 'secondary')) }}">
                                {{ ucfirst($skill->category) }}
                            </span>
                        </td>
                        <td>
                            <div class="progress" style="width: 100px; height: 20px;">
                                <div class="progress-bar bg-{{ $skill->proficiency_level >= 80 ? 'success' : ($skill->proficiency_level >= 60 ? 'info' : 'warning') }}"
                                     style="width: {{ $skill->proficiency_level }}%">
                                    {{ $skill->proficiency_level }}%
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($skill->icon_class)
                                <i class="{{ $skill->icon_class }} fa-lg"></i>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($skill->is_featured)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
            {{ $skills->links() }}
        </div>
    </div>
</div>
@endsection
