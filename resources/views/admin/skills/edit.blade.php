@extends('admin.layouts.app')

@section('title', 'Edit Skill')
@section('page-title', 'Edit Skill: ' . $skill->name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Skill Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $skill->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                            @foreach(['backend', 'frontend', 'devops', 'tools', 'other'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $skill->category) == $cat ? 'selected' : '' }}>
                                    {{ ucfirst($cat) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="icon_class" class="form-label">FontAwesome Icon Class</label>
                        <input type="text" class="form-control @error('icon_class') is-invalid @enderror" name="icon_class" value="{{ old('icon_class', $skill->icon_class) }}" placeholder="e.g., fab fa-laravel">
                        <small class="text-muted">Use FontAwesome classes</small>
                        @error('icon_class') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="proficiency_level" class="form-label">Proficiency Level (%) *</label>
                        <input type="range" class="form-range @error('proficiency_level') is-invalid @enderror" name="proficiency_level" min="0" max="100" value="{{ old('proficiency_level', $skill->proficiency_level) }}" id="proficiencyRange">
                        <div class="d-flex justify-content-between">
                            <small>0%</small>
                            <span id="proficiencyValue">{{ old('proficiency_level', $skill->proficiency_level) }}%</span>
                            <small>100%</small>
                        </div>
                        @error('proficiency_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order_number" class="form-label">Display Order</label>
                        <input type="number" class="form-control @error('order_number') is-invalid @enderror" name="order_number" value="{{ old('order_number', $skill->order_number) }}" min="0">
                        @error('order_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured Skill</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('proficiencyRange').addEventListener('input', function(e) {
    document.getElementById('proficiencyValue').textContent = e.target.value + '%';
});
</script>
@endpush