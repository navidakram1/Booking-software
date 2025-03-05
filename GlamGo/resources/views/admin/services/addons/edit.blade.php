@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Addon</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.addons') }}">Service Addons</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.addons.show', $addon->id) }}">{{ $addon->name }}</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Addon Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.services.addons.update', $addon->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ $addon->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" required>{{ $addon->description }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" 
                                       step="0.01" value="{{ $addon->price }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Duration (minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" 
                                       value="{{ $addon->duration }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" 
                                            {{ $addon->category === $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Compatible Services</label>
                            <div class="row g-3">
                                @foreach($services as $service)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="compatible_services[]" 
                                                   value="{{ $service->id }}" 
                                                   id="service{{ $service->id }}"
                                                   {{ in_array($service->name, $addon->compatible_services) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="service{{ $service->id }}">
                                                {{ $service->name }}
                                                <small class="text-muted d-block">{{ $service->category }}</small>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" 
                                       name="is_active" {{ $addon->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.services.addons.show', $addon->id) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Addon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Current Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Status</span>
                            <span class="badge bg-{{ $addon->is_active ? 'success' : 'warning' }}">
                                {{ $addon->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Popularity</span>
                            <span class="badge bg-{{ $addon->popular ? 'info' : 'light text-dark' }}">
                                {{ $addon->popular ? 'Popular' : 'Standard' }}
                            </span>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h6 class="alert-heading fw-bold">Note</h6>
                        <p class="mb-0">Changes will be immediately reflected in the booking system. Make sure all information is accurate before updating.</p>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Deleting this addon will remove it from all future bookings. This action cannot be undone.</p>
                    <form action="{{ route('admin.services.addons.destroy', $addon->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Are you sure you want to delete this addon? This action cannot be undone.')">
                            <i class="fas fa-trash me-1"></i> Delete Addon
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
