@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Services</h3>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add New Service</a>
                </div>
                <div class="card-body">
                    <!-- Simplified Search Form -->
                    <form action="{{ route('admin.services.search') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Search services..." value="{{ request('query') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="category" class="form-control">
                                    <option value="">All Categories</option>
                                    <option value="hair" {{ request('category') == 'hair' ? 'selected' : '' }}>Hair</option>
                                    <option value="nails" {{ request('category') == 'nails' ? 'selected' : '' }}>Nails</option>
                                    <option value="facial" {{ request('category') == 'facial' ? 'selected' : '' }}>Facial</option>
                                    <option value="massage" {{ request('category') == 'massage' ? 'selected' : '' }}>Massage</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary w-100">Reset</a>
                            </div>
                        </div>
                    </form>

                    <!-- Services Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                    <tr>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ ucfirst($service->category) }}</td>
                                        <td>${{ number_format($service->price, 2) }}</td>
                                        <td>{{ $service->duration }} minutes</td>
                                        <td>
                                            <span class="badge badge-{{ $service->status === 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($service->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No services found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
