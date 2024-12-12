@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Landing Page Management</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-home me-1"></i>
            Hero Section
        </div>
        <div class="card-body">
            <form action="{{ route('admin.content.landing.hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="hero_title" value="{{ $landingPage->hero_title }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subtitle</label>
                            <input type="text" class="form-control" name="hero_subtitle" value="{{ $landingPage->hero_subtitle }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Text</label>
                            <input type="text" class="form-control" name="hero_cta_text" value="{{ $landingPage->hero_cta_text }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Link</label>
                            <input type="text" class="form-control" name="hero_cta_link" value="{{ $landingPage->hero_cta_link }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Hero Image</label>
                            @if($landingPage->hero_image)
                                <img src="{{ $landingPage->hero_image_url }}" class="img-thumbnail mb-2 d-block" style="max-height: 200px">
                            @endif
                            <input type="file" class="form-control" name="hero_image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hero Video</label>
                            @if($landingPage->hero_video)
                                <video class="mb-2 d-block" style="max-height: 200px" controls>
                                    <source src="{{ $landingPage->hero_video_url }}" type="video/mp4">
                                </video>
                            @endif
                            <input type="file" class="form-control" name="hero_video" accept="video/mp4">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Hero Section</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            About Section
        </div>
        <div class="card-body">
            <form action="{{ route('admin.content.landing.about') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="about_title" value="{{ $landingPage->about_title }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" name="about_content" rows="5" required>{{ $landingPage->about_content }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">About Image</label>
                            @if($landingPage->about_image)
                                <img src="{{ $landingPage->about_image_url }}" class="img-thumbnail mb-2 d-block" style="max-height: 200px">
                            @endif
                            <input type="file" class="form-control" name="about_image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">About Video</label>
                            @if($landingPage->about_video)
                                <video class="mb-2 d-block" style="max-height: 200px" controls>
                                    <source src="{{ $landingPage->about_video_url }}" type="video/mp4">
                                </video>
                            @endif
                            <input type="file" class="form-control" name="about_video" accept="video/mp4">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update About Section</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list me-1"></i>
            Features Section
        </div>
        <div class="card-body">
            <form action="{{ route('admin.content.landing.features') }}" method="POST" id="featuresForm">
                @csrf
                @method('PUT')
                
                <div id="features-container">
                    @foreach($landingPage->features ?? [] as $index => $feature)
                    <div class="feature-item border p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Feature #{{ $index + 1 }}</h5>
                            <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="features[{{ $index }}][title]" value="{{ $feature['title'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="features[{{ $index }}][description]" required>{{ $feature['description'] }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" class="form-control" name="features[{{ $index }}][icon]" value="{{ $feature['icon'] }}" required>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn btn-success mb-3" id="add-feature">Add Feature</button>
                <button type="submit" class="btn btn-primary">Update Features</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-bar me-1"></i>
            Stats Section
        </div>
        <div class="card-body">
            <form action="{{ route('admin.content.landing.stats') }}" method="POST" id="statsForm">
                @csrf
                @method('PUT')
                
                <div id="stats-container">
                    @foreach($landingPage->stats ?? [] as $index => $stat)
                    <div class="stat-item border p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Stat #{{ $index + 1 }}</h5>
                            <button type="button" class="btn btn-danger btn-sm remove-stat">Remove</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <input type="text" class="form-control" name="stats[{{ $index }}][label]" value="{{ $stat['label'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" name="stats[{{ $index }}][value]" value="{{ $stat['value'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" class="form-control" name="stats[{{ $index }}][icon]" value="{{ $stat['icon'] }}" required>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn btn-success mb-3" id="add-stat">Add Stat</button>
                <button type="submit" class="btn btn-primary">Update Stats</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-images me-1"></i>
            Gallery Section
        </div>
        <div class="card-body">
            <form action="{{ route('admin.content.landing.gallery.add') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Caption</label>
                            <input type="text" class="form-control" name="caption">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Add Image</button>
            </form>

            <div class="row" id="gallery-container">
                @foreach($galleryImages as $image)
                <div class="col-md-4 mb-4" data-id="{{ $image->id }}">
                    <div class="card">
                        <img src="{{ $image->image_url }}" class="card-img-top" alt="{{ $image->caption }}">
                        <div class="card-body">
                            <p class="card-text">{{ $image->caption }}</p>
                            <form action="{{ route('admin.content.landing.gallery.remove', $image->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Features Section
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const index = container.children.length;
        const template = `
            <div class="feature-item border p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">Feature #${index + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="features[${index}][title]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="features[${index}][description]" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="features[${index}][icon]" required>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.feature-item').remove();
            updateFeatureIndexes();
        }
    });

    function updateFeatureIndexes() {
        const features = document.querySelectorAll('.feature-item');
        features.forEach((feature, index) => {
            feature.querySelector('h5').textContent = `Feature #${index + 1}`;
            feature.querySelectorAll('input, textarea').forEach(input => {
                input.name = input.name.replace(/features\[\d+\]/, `features[${index}]`);
            });
        });
    }

    // Stats Section
    document.getElementById('add-stat').addEventListener('click', function() {
        const container = document.getElementById('stats-container');
        const index = container.children.length;
        const template = `
            <div class="stat-item border p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">Stat #${index + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-stat">Remove</button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Label</label>
                    <input type="text" class="form-control" name="stats[${index}][label]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Value</label>
                    <input type="number" class="form-control" name="stats[${index}][value]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="stats[${index}][icon]" required>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-stat')) {
            e.target.closest('.stat-item').remove();
            updateStatIndexes();
        }
    });

    function updateStatIndexes() {
        const stats = document.querySelectorAll('.stat-item');
        stats.forEach((stat, index) => {
            stat.querySelector('h5').textContent = `Stat #${index + 1}`;
            stat.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace(/stats\[\d+\]/, `stats[${index}]`);
            });
        });
    }

    // Gallery Sorting
    new Sortable(document.getElementById('gallery-container'), {
        animation: 150,
        onEnd: function() {
            const items = document.querySelectorAll('#gallery-container > div');
            const order = Array.from(items).map(item => item.dataset.id);
            
            fetch('{{ route('admin.content.landing.gallery.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ order })
            });
        }
    });
</script>
@endpush
@endsection
