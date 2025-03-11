@extends('layouts.admin')

@section('title', 'Admin Profile - GlamGo')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h3 mb-4 text-gray-800">Profile Settings</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <!-- Profile Information -->
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Profile Picture</label>
                            <div class="d-flex align-items-center">
                                <img src="{{ $admin->avatar ? Storage::url('avatars/'.$admin->avatar) : asset('images/default-avatar.png') }}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle me-3"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                            </div>
                            @error('avatar')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
                            @error('phone')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Profile
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            @error('current_password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Account Security -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Account Security</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Two-Factor Authentication</h6>
                        <p class="text-muted mb-2">Add additional security to your account using two-factor authentication.</p>
                        <button class="btn btn-outline-primary" disabled>
                            Coming Soon
                        </button>
                    </div>

                    <div class="mb-3">
                        <h6 class="font-weight-bold">Browser Sessions</h6>
                        <p class="text-muted mb-2">Manage and log out your active sessions on other browsers and devices.</p>
                        <button class="btn btn-outline-danger">
                            Log Out Other Browser Sessions
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview uploaded image
    document.getElementById('avatar').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('img').src = e.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
});
</script>
@endsection 