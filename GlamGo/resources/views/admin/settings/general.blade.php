@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">General Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">General Settings</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-cog me-1"></i>
            Business Information
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.general.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="site_name" class="form-label">Business Name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" 
                           value="{{ setting('site_name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="site_description" class="form-label">Business Description</label>
                    <textarea class="form-control" id="site_description" name="site_description" 
                              rows="3">{{ setting('site_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="contact_email" class="form-label">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" 
                           value="{{ setting('contact_email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                           value="{{ setting('contact_phone') }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Business Address</label>
                    <textarea class="form-control" id="address" name="address" 
                              rows="2" required>{{ setting('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Business Hours</label>
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        $hours = setting('business_hours', []);
                    @endphp
                    
                    @foreach($days as $day)
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label class="form-check-label">
                                    {{ $day }}
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="time" class="form-control" 
                                       name="business_hours[{{ $day }}][open]" 
                                       value="{{ $hours[$day]['open'] ?? '09:00' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="time" class="form-control" 
                                       name="business_hours[{{ $day }}][close]" 
                                       value="{{ $hours[$day]['close'] ?? '18:00' }}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="business_hours[{{ $day }}][closed]" 
                                           value="1" {{ isset($hours[$day]['closed']) && $hours[$day]['closed'] ? 'checked' : '' }}>
                                    <label class="form-check-label">Closed</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Social Media Links</label>
                    @php
                        $social = setting('social_media', []);
                        $platforms = ['Facebook', 'Instagram', 'Twitter', 'LinkedIn'];
                    @endphp
                    
                    @foreach($platforms as $platform)
                        <div class="mb-2">
                            <label class="form-label">{{ $platform }}</label>
                            <input type="url" class="form-control" 
                                   name="social_media[{{ strtolower($platform) }}]" 
                                   value="{{ $social[strtolower($platform)] ?? '' }}" 
                                   placeholder="https://">
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
