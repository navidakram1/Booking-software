@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Customer Reviews</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-star me-1"></i>
            Customer Reviews and Ratings
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="reviewsTable">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Service</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            @foreach($customer->reviews as $review)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $review->service->name }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ Str::limit($review->comment, 100) }}</td>
                                <td>{{ $review->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $review->is_published ? 'success' : 'warning' }}">
                                        {{ $review->is_published ? 'Published' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-info btn-sm" 
                                                onclick="viewReview({{ $review->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if(!$review->is_published)
                                        <button type="button" class="btn btn-success btn-sm" 
                                                onclick="publishReview({{ $review->id }})">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="deleteReview({{ $review->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $customers->links() }}
        </div>
    </div>
</div>

<!-- View Review Modal -->
<div class="modal fade" id="viewReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="reviewContent"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#reviewsTable').DataTable({
            order: [[4, 'desc']],
            pageLength: 25,
        });
    });

    function viewReview(reviewId) {
        // Implement review view logic
        $('#viewReviewModal').modal('show');
    }

    function publishReview(reviewId) {
        if (confirm('Are you sure you want to publish this review?')) {
            // Implement publish logic
        }
    }

    function deleteReview(reviewId) {
        if (confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
            // Implement delete logic
        }
    }
</script>
@endpush
