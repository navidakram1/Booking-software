@extends('layouts.main')

@section('title', 'My Reviews - GlamGo')

@push('styles')
<style>
    .star-rating {
        color: #FFD700;
    }
    .review-card {
        transition: all 0.3s ease;
    }
    .review-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    My Reviews
                </span>
            </h1>
            <p class="text-lg text-gray-600">Share your experience and help others make informed decisions</p>
        </div>

        <!-- Review Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 text-center">
                <div class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['total_reviews'] }}</div>
                <div class="text-gray-600">Total Reviews</div>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 text-center">
                <div class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['average_rating'] }}</div>
                <div class="text-gray-600">Average Rating</div>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 text-center">
                <div class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['services_reviewed'] }}</div>
                <div class="text-gray-600">Services Reviewed</div>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 text-center">
                <div class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['stylists_reviewed'] }}</div>
                <div class="text-gray-600">Stylists Reviewed</div>
            </div>
        </div>

        <!-- Write Review Button -->
        <div class="text-center mb-12">
            <button onclick="openReviewModal()" class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg">
                Write a New Review
            </button>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($reviews as $review)
            <div class="review-card bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="{{ $review['service']['image'] }}" 
                             alt="{{ $review['service']['name'] }}" 
                             class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">{{ $review['service']['name'] }}</h3>
                            <p class="text-sm text-gray-600">by {{ $review['stylist']['name'] }}</p>
                        </div>
                    </div>
                    <div class="star-rating">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $review['rating'])
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                </div>
                <p class="text-gray-600 mb-4">
                    {{ $review['comment'] }}
                </p>
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>{{ $review['created_at']->diffForHumans() }}</span>
                    <div class="flex space-x-2">
                        <button class="hover:text-pink-500" onclick="editReview({{ $review['id'] }})">Edit</button>
                        <button class="hover:text-red-500" onclick="deleteReview({{ $review['id'] }})">Delete</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Review Modal -->
        <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-lg w-full mx-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Write a Review</h2>
                <form id="reviewForm" onsubmit="submitReview(event)">
                    <input type="hidden" id="reviewId" name="id">
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Service</label>
                        <select name="service_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            @foreach($services as $service)
                                <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Stylist</label>
                        <select name="stylist_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            @foreach($stylists as $stylist)
                                <option value="{{ $stylist['id'] }}">{{ $stylist['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Rating</label>
                        <div class="flex space-x-2 text-2xl star-rating">
                            <input type="hidden" name="rating" id="ratingInput" value="5">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating({{ $i }})" class="rating-star">★</button>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Review</label>
                        <textarea name="comment" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent" rows="4" placeholder="Share your experience..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeReviewModal()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-700">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let isEditing = false;

function openReviewModal() {
    isEditing = false;
    document.getElementById('reviewForm').reset();
    document.getElementById('reviewId').value = '';
    document.getElementById('reviewModal').classList.remove('hidden');
    document.getElementById('reviewModal').classList.add('flex');
    setRating(5); // Default rating
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.add('hidden');
    document.getElementById('reviewModal').classList.remove('flex');
}

function setRating(rating) {
    document.getElementById('ratingInput').value = rating;
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, index) => {
        star.style.opacity = index < rating ? '1' : '0.5';
    });
}

async function submitReview(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    
    try {
        const url = isEditing 
            ? `/reviews/${data.id}`
            : '/reviews';
        
        const method = isEditing ? 'PUT' : 'POST';
        
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            window.location.reload();
        } else {
            throw new Error('Failed to submit review');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to submit review. Please try again.');
    }
}

async function editReview(id) {
    isEditing = true;
    // In development, we'll just show the form with empty values
    document.getElementById('reviewId').value = id;
    document.getElementById('reviewModal').classList.remove('hidden');
    document.getElementById('reviewModal').classList.add('flex');
}

async function deleteReview(id) {
    if (!confirm('Are you sure you want to delete this review?')) {
        return;
    }

    try {
        const response = await fetch(`/reviews/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (response.ok) {
            window.location.reload();
        } else {
            throw new Error('Failed to delete review');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to delete review. Please try again.');
    }
}

// Close modal when clicking outside
document.getElementById('reviewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReviewModal();
    }
});

// Set initial rating
document.addEventListener('DOMContentLoaded', () => {
    setRating(5);
});
</script>
@endpush
@endsection
