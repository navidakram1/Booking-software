@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Service Addons</h1>
        <a href="{{ route('admin.service-addons.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Addon
        </a>
    </div>

    <div class="row">
        <!-- Category Filter -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary active">All</button>
                        @foreach($categories as $category)
                            <button class="btn btn-outline-primary">{{ $category }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Addons Grid -->
        <div class="col-12">
            <div class="row">
                @foreach($addons as $addon)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $addon->name }}</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.services.addons.show', $addon->id) }}">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.services.addons.edit', $addon->id) }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.services.addons.toggle', $addon->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-toggle-{{ $addon->is_active ? 'on' : 'off' }}"></i>
                                                        {{ $addon->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.services.addons.destroy', $addon->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this addon?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <p class="card-text text-muted mb-3">{{ $addon->description }}</p>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="badge bg-primary">{{ $addon->category }}</span>
                                    @if($addon->popular)
                                        <span class="badge bg-success">Popular</span>
                                    @endif
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="p-2 border rounded text-center">
                                            <small class="d-block text-muted">Price</small>
                                            <strong>${{ number_format($addon->price, 2) }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 border rounded text-center">
                                            <small class="d-block text-muted">Duration</small>
                                            <strong>{{ $addon->duration }} min</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Compatible Services:</small>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($addon->compatible_services as $service)
                                            <span class="badge bg-light text-dark">{{ $service }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-check text-success me-2"></i>
                                    <span>{{ $addon->bookings_count }} bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
