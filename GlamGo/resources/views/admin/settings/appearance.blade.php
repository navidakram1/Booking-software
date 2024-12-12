@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Appearance Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.appearance.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Theme Settings -->
                        <div class="mb-4">
                            <h4>Theme Settings</h4>
                            <div class="form-group">
                                <label for="color_scheme">Color Scheme</label>
                                <select class="form-control" id="color_scheme" name="color_scheme">
                                    <option value="light" {{ setting('color_scheme') === 'light' ? 'selected' : '' }}>Light</option>
                                    <option value="dark" {{ setting('color_scheme') === 'dark' ? 'selected' : '' }}>Dark</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primary_color">Primary Color</label>
                                <input type="color" class="form-control" id="primary_color" name="primary_color" value="{{ old('primary_color', setting('primary_color')) }}">
                            </div>
                            <div class="form-group">
                                <label for="secondary_color">Secondary Color</label>
                                <input type="color" class="form-control" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', setting('secondary_color')) }}">
                            </div>
                        </div>

                        <!-- Logo Settings -->
                        <div class="mb-4">
                            <h4>Logo Settings</h4>
                            <div class="form-group">
                                <label for="site_logo">Site Logo</label>
                                <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*">
                                @if(setting('site_logo'))
                                    <img src="{{ asset('storage/' . setting('site_logo')) }}" alt="Site Logo" class="mt-2" style="max-height: 50px">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="favicon" accept="image/x-icon,image/png">
                                @if(setting('favicon'))
                                    <img src="{{ asset('storage/' . setting('favicon')) }}" alt="Favicon" class="mt-2" style="max-height: 32px">
                                @endif
                            </div>
                        </div>

                        <!-- Font Settings -->
                        <div class="mb-4">
                            <h4>Font Settings</h4>
                            <div class="form-group">
                                <label for="heading_font">Heading Font</label>
                                <select class="form-control" id="heading_font" name="heading_font">
                                    <option value="Roboto" {{ setting('heading_font') === 'Roboto' ? 'selected' : '' }}>Roboto</option>
                                    <option value="Open Sans" {{ setting('heading_font') === 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                    <option value="Montserrat" {{ setting('heading_font') === 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body_font">Body Font</label>
                                <select class="form-control" id="body_font" name="body_font">
                                    <option value="Roboto" {{ setting('body_font') === 'Roboto' ? 'selected' : '' }}>Roboto</option>
                                    <option value="Open Sans" {{ setting('body_font') === 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                    <option value="Lato" {{ setting('body_font') === 'Lato' ? 'selected' : '' }}>Lato</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
