@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">{{ $addon->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.addons') }}">Service Addons</a></li>
                    <li class="breadcrumb-item active">{{ $addon->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.services.addons.edit', $addon->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Addon
            </a>
            <form action="{{ route('admin.services.addons.toggle', $addon->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-{{ $addon->is_active ? 'warning' : 'success' }}">
                    <i class="fas fa-toggle-{{ $addon->is_active ? 'on' : 'off' }}"></i>
                    {{ $addon->is_active ? 'Deactivate' : 'Activate' }}
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Basic Information -->
        <div class="col-md-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="mb-0">Addon Details</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Category</h6>
                            <p class="mb-3">{{ $addon->category }}</p>

                            <h6 class="text-muted mb-1">Price</h6>
                            <p class="mb-3">${{ number_format($addon->price, 2) }}</p>

                            <h6 class="text-muted mb-1">Duration</h6>
                            <p class="mb-3">{{ $addon->duration }} minutes</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Status</h6>
                            <p class="mb-3">
                                <span class="badge bg-{{ $addon->is_active ? 'success' : 'warning' }}">
                                    {{ $addon->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                @if($addon->popular)
                                    <span class="badge bg-info ms-1">Popular</span>
                                @endif
                            </p>

                            <h6 class="text-muted mb-1">Created</h6>
                            <p class="mb-3">{{ $addon->created_at->format('M d, Y') }}</p>

                            <h6 class="text-muted mb-1">Last Updated</h6>
                            <p class="mb-3">{{ $addon->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <h6 class="text-muted mb-2">Description</h6>
                    <p class="mb-4">{{ $addon->description }}</p>

                    <h6 class="text-muted mb-2">Compatible Services</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @foreach($addon->compatible_services as $service)
                            <span class="badge bg-light text-dark">{{ $service }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="col-md-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Performance Overview</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Total Bookings</span>
                            <span class="fw-bold">{{ $addon->bookings_count }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total Revenue</span>
                            <span class="fw-bold">${{ number_format($addon->revenue, 2) }}</span>
                        </div>
                    </div>

                    <h6 class="text-muted mb-3">Monthly Statistics</h6>
                    @foreach($addon->monthly_stats as $stat)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>{{ $stat->month }}</span>
                                <span class="text-success">${{ number_format($stat->revenue, 2) }}</span>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ ($stat->bookings / $addon->bookings_count) * 100 }}%"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">{{ $stat->bookings }} bookings</small>
                                <small class="text-muted">{{ number_format(($stat->bookings / $addon->bookings_count) * 100, 1) }}%</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
