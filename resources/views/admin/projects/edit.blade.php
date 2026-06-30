@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project: ' . $project->title)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $project->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" required>{{ old('description', $project->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    @if($project->image_path)
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="{{ asset('images/' . $project->image_path) }}" alt="{{ $project->title }}" style="max-width: 200px; max-height: 150px;" class="img-thumbnail mb-2">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image (Optional)</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                        <small class="text-muted">Upload new image to replace current</small>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tech Stack</label>
                        <div id="tech-stack-container">
                            @if($project->tech_stack && count($project->tech_stack) > 0)
                                @foreach($project->tech_stack as $tech)
                                    <div class="input-group mb-2">
                                        <input type="text" name="tech_stack[]" class="form-control" value="{{ $tech }}" placeholder="e.g., Laravel">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Remove</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="tech_stack[]" class="form-control" placeholder="e.g., Laravel">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Remove</button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addTechStack()">+ Add Tech</button>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="github_link" class="form-label">GitHub URL</label>
                            <input type="url" class="form-control @error('github_link') is-invalid @enderror" name="github_link" value="{{ old('github_link', $project->github_link) }}">
                            @error('github_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="live_link" class="form-label">Live Demo URL</label>
                            <input type="url" class="form-control @error('live_link') is-invalid @enderror" name="live_link" value="{{ old('live_link', $project->live_link) }}">
                            @error('live_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_number" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order_number') is-invalid @enderror" name="order_number" value="{{ old('order_number', $project->order_number) }}" min="0">
                            @error('order_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label">Featured Project</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function addTechStack() {
    const container = document.getElementById('tech-stack-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" name="tech_stack[]" class="form-control" placeholder="e.g., PHP">
        <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Remove</button>
    `;
    container.appendChild(div);
}
</script>
@endpush