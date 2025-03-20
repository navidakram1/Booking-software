namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
            'service_rating' => 'required|integer|between:1,5',
            'specialist_rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean'
        ]);

        // Check if user has already reviewed this booking
        $existingReview = Review::where('booking_id', $validated['booking_id'])
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this booking'
            ], 422);
        }

        // Create the review
        $review = Review::create([
            'user_id' => auth()->id(),
            'booking_id' => $validated['booking_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'service_rating' => $validated['service_rating'],
            'specialist_rating' => $validated['specialist_rating'],
            'would_recommend' => $validated['would_recommend']
        ]);

        // Update service and specialist average ratings
        $this->updateServiceRating($review->booking->service_id);
        $this->updateSpecialistRating($review->booking->specialist_id);

        // Clear related caches
        $this->clearRelatedCaches($review);

        return response()->json([
            'message' => 'Review submitted successfully',
            'review' => $review->load(['user', 'booking.service', 'booking.specialist'])
        ]);
    }

    public function userReviews()
    {
        $reviews = Review::where('user_id', auth()->id())
            ->with(['booking.service', 'booking.specialist'])
            ->latest()
            ->paginate(10);

        return response()->json($reviews);
    }

    public function serviceReviews(Service $service)
    {
        $reviews = Review::whereHas('booking', function ($query) use ($service) {
            $query->where('service_id', $service->id);
        })
        ->with(['user', 'booking.specialist'])
        ->latest()
        ->paginate(10);

        return response()->json($reviews);
    }

    public function specialistReviews(Specialist $specialist)
    {
        $reviews = Review::whereHas('booking', function ($query) use ($specialist) {
            $query->where('specialist_id', $specialist->id);
        })
        ->with(['user', 'booking.service'])
        ->latest()
        ->paginate(10);

        return response()->json($reviews);
    }

    private function updateServiceRating($serviceId)
    {
        $service = Service::find($serviceId);
        $averageRating = Review::whereHas('booking', function ($query) use ($serviceId) {
            $query->where('service_id', $serviceId);
        })->avg('service_rating');

        $service->update([
            'rating' => round($averageRating, 1),
            'reviews_count' => $service->reviews()->count()
        ]);
    }

    private function updateSpecialistRating($specialistId)
    {
        $specialist = Specialist::find($specialistId);
        $averageRating = Review::whereHas('booking', function ($query) use ($specialistId) {
            $query->where('specialist_id', $specialistId);
        })->avg('specialist_rating');

        $specialist->update([
            'rating' => round($averageRating, 1),
            'reviews_count' => $specialist->reviews()->count()
        ]);
    }

    private function clearRelatedCaches(Review $review)
    {
        $keys = [
            "service_{$review->booking->service_id}_reviews",
            "specialist_{$review->booking->specialist_id}_reviews",
            "service_{$review->booking->service_id}_rating",
            "specialist_{$review->booking->specialist_id}_rating"
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }
} 