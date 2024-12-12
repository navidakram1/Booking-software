@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Testimonials Management</h2>
        <button onclick="openAddModal()" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
            Add New Testimonial
        </button>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($testimonials as $testimonial)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        @if($testimonial->customer->avatar)
                            <img src="{{ Storage::url($testimonial->customer->avatar) }}" alt="{{ $testimonial->customer->name }}" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">
                                <span class="text-pink-600 text-lg font-semibold">{{ substr($testimonial->customer->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">{{ $testimonial->customer->name }}</h3>
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>

                    @if($testimonial->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($testimonial->image) }}" alt="Testimonial Image" class="w-full h-48 object-cover rounded-lg">
                        </div>
                    @endif

                    <p class="text-gray-600 mb-4">{{ $testimonial->content }}</p>

                    @if($testimonial->service)
                        <div class="mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                {{ $testimonial->service->name }}
                            </span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-4 pt-4 border-t">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">{{ $testimonial->created_at->diffForHumans() }}</span>
                            <span class="text-sm px-2 py-1 rounded {{ $testimonial->status === 'approved' ? 'bg-green-100 text-green-800' : ($testimonial->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($testimonial->status) }}
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            @if($testimonial->status === 'pending')
                                <button onclick="approveTestimonial({{ $testimonial->id }})" class="text-green-600 hover:text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            @endif
                            <button onclick="editTestimonial({{ $testimonial->id }})" class="text-blue-600 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteTestimonial({{ $testimonial->id }})" class="text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3">
                <div class="text-center py-12 bg-white rounded-xl">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No testimonials</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new testimonial.</p>
                    <div class="mt-6">
                        <button onclick="openAddModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Testimonial
                        </button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $testimonials->links() }}
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="testimonialModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium" id="modalTitle">Add New Testimonial</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="testimonialForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Customer</label>
                    <select name="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <!-- Populate with customers -->
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                    <select name="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Service (Optional)</label>
                    <select name="service_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="">Select a service</option>
                        <!-- Populate with services -->
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full">
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-50">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-md hover:bg-pink-600">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Add New Testimonial';
        document.getElementById('testimonialForm').action = '{{ route('admin.content.testimonials.store') }}';
        document.getElementById('testimonialForm').method = 'POST';
        document.getElementById('testimonialModal').classList.remove('hidden');
    }

    function editTestimonial(id) {
        document.getElementById('modalTitle').textContent = 'Edit Testimonial';
        document.getElementById('testimonialForm').action = `/admin/content/testimonials/${id}`;
        document.getElementById('testimonialForm').method = 'POST';
        let methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PUT';
        document.getElementById('testimonialForm').appendChild(methodField);
        document.getElementById('testimonialModal').classList.remove('hidden');
        
        // Fetch testimonial data and populate form
        fetch(`/admin/content/testimonials/${id}`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('[name="customer_id"]').value = data.customer_id;
                document.querySelector('[name="content"]').value = data.content;
                document.querySelector('[name="rating"]').value = data.rating;
                document.querySelector('[name="service_id"]').value = data.service_id || '';
            });
    }

    function closeModal() {
        document.getElementById('testimonialModal').classList.add('hidden');
        document.getElementById('testimonialForm').reset();
    }

    function approveTestimonial(id) {
        if (confirm('Are you sure you want to approve this testimonial?')) {
            fetch(`/admin/content/testimonials/${id}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => window.location.reload());
        }
    }

    function deleteTestimonial(id) {
        if (confirm('Are you sure you want to delete this testimonial?')) {
            fetch(`/admin/content/testimonials/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => window.location.reload());
        }
    }

    // Close modal when clicking outside
    document.getElementById('testimonialModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
