@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Add New Addon</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.addons') }}">Service Addons</a></li>
                    <li class="breadcrumb-item active">Add New</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Addon Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.services.addons.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Duration (minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
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
                                                   id="service{{ $service->id }}">
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
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.services.addons') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Addon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Guidelines</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Addon Name</h6>
                        <p class="text-muted">Choose a clear, descriptive name that reflects the service being offered.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Description</h6>
                        <p class="text-muted">Provide a detailed description of what the addon includes and its benefits.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Pricing</h6>
                        <p class="text-muted">Set a competitive price that reflects the value and duration of the service.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Compatible Services</h6>
                        <p class="text-muted">Select the main services that this addon can be combined with.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
