@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Import/Export Customers</h1>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-import me-1"></i>
                    Import Customers
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.customers.import.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">CSV File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".csv" required>
                            <div class="form-text">
                                Please upload a CSV file with the following columns: Name, Email, Phone, Address, Date of Birth, Notes, Status
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Import Customers</button>
                    </form>

                    <div class="mt-4">
                        <h5>Sample CSV Format</h5>
                        <pre class="bg-light p-3 rounded">
Name,Email,Phone,Address,Date of Birth,Notes,Status
John Doe,john@example.com,1234567890,123 Main St,1990-01-01,Regular customer,Active
Jane Smith,jane@example.com,0987654321,456 Oak Ave,1985-05-15,VIP customer,Active</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-export me-1"></i>
                    Export Customers
                </div>
                <div class="card-body">
                    <p>Download a CSV file containing all customer records.</p>
                    <a href="{{ route('admin.customers.export') }}" class="btn btn-success">
                        <i class="fas fa-download me-1"></i>
                        Export Customers
                    </a>

                    <div class="mt-4">
                        <h5>Export Format</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>All customer details</li>
                            <li><i class="fas fa-check text-success me-2"></i>Contact information</li>
                            <li><i class="fas fa-check text-success me-2"></i>Customer status</li>
                            <li><i class="fas fa-check text-success me-2"></i>Additional notes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>
@endsection
