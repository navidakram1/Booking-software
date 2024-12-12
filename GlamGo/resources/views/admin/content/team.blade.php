@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Team Members</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTeamMemberModal">
                        Add Team Member
                    </button>
                </div>
                <div class="card-body">
                    <div class="row" id="teamMembersGrid">
                        @foreach($team as $member)
                        <div class="col-md-4 mb-4" data-id="{{ $member->id }}">
                            <div class="card">
                                <img src="{{ $member->image_url }}" class="card-img-top" alt="{{ $member->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $member->name }}</h5>
                                    <p class="card-text text-muted">{{ $member->role }}</p>
                                    <p class="card-text">{{ Str::limit($member->bio, 100) }}</p>
                                    <div class="mt-3">
                                        @if($member->instagram)
                                        <a href="{{ $member->instagram }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        @endif
                                        @if($member->facebook)
                                        <a href="{{ $member->facebook }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                        @endif
                                        @if($member->twitter)
                                        <a href="{{ $member->twitter }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        @endif
                                        @if($member->linkedin)
                                        <a href="{{ $member->linkedin }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-info" onclick="editTeamMember({{ $member->id }})">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.content.team.destroy', $member->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $team->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Team Member Modal -->
<div class="modal fade" id="addTeamMemberModal" tabindex="-1" role="dialog" aria-labelledby="addTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.content.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeamMemberModalLabel">Add Team Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" id="role" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="services">Services</label>
                        <select class="form-control" id="services" name="services[]" multiple>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram URL</label>
                        <input type="url" class="form-control" id="instagram" name="instagram">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook URL</label>
                        <input type="url" class="form-control" id="facebook" name="facebook">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter URL</label>
                        <input type="url" class="form-control" id="twitter" name="twitter">
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn URL</label>
                        <input type="url" class="form-control" id="linkedin" name="linkedin">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Team Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Team Member Modal -->
<div class="modal fade" id="editTeamMemberModal" tabindex="-1" role="dialog" aria-labelledby="editTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editTeamMemberForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeamMemberModalLabel">Edit Team Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form fields will be populated via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Team Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
// Enable drag and drop reordering
new Sortable(document.getElementById('teamMembersGrid'), {
    animation: 150,
    onEnd: function() {
        const order = Array.from(document.querySelectorAll('#teamMembersGrid > div')).map(el => el.dataset.id);
        fetch('{{ route("admin.content.team.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ order })
        });
    }
});

function editTeamMember(memberId) {
    // Fetch team member data and populate the edit modal
    fetch(`/admin/content/team/${memberId}/edit`)
        .then(response => response.json())
        .then(data => {
            const form = document.getElementById('editTeamMemberForm');
            form.action = `/admin/content/team/${memberId}`;
            
            // Populate form fields
            form.querySelector('#name').value = data.name;
            form.querySelector('#role').value = data.role;
            form.querySelector('#bio').value = data.bio;
            
            // Set selected services
            const servicesSelect = form.querySelector('#services');
            data.services.forEach(serviceId => {
                const option = servicesSelect.querySelector(`option[value="${serviceId}"]`);
                if (option) option.selected = true;
            });
            
            // Set social media URLs
            form.querySelector('#instagram').value = data.instagram || '';
            form.querySelector('#facebook').value = data.facebook || '';
            form.querySelector('#twitter').value = data.twitter || '';
            form.querySelector('#linkedin').value = data.linkedin || '';
            
            $('#editTeamMemberModal').modal('show');
        });
}
</script>
@endpush
