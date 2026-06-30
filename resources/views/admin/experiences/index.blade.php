@extends('admin.layouts.app')

@section('title', 'Experiences')
@section('page-title', 'Manage Experience')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.experiences.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Experience
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Duration</th>
                        <th>Current</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($experiences as $exp)
                    <tr>
                        <td>{{ $exp->id }}</td>
                        <td>
                            <strong>{{ $exp->title }}</strong>
                        </td>
                        <td>{{ $exp->company }}</td>
                        <td>
                            {{ $exp->start_date->format('M Y') }} -
                            @if($exp->is_current)
                                <span class="badge bg-success">Present</span>
                            @else
                                {{ $exp->end_date->format('M Y') }}
                            @endif
                        </td>
                        <td>
                            @if($exp->is_current)
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="far fa-circle text-muted"></i>
                            @endif
                        </td>
                        <td>{{ $exp->order_number }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
            {{ $experiences->links() }}
        </div>
    </div>
</div>
@endsection
