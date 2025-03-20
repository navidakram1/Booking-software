namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'slug' => $service->slug,
                    'short_description' => $service->short_description,
                    'category' => $service->category,
                    'price' => $service->price,
                    'duration' => $service->duration,
                    'rating' => $service->rating,
                    'reviews_count' => $service->reviews_count,
                    'thumbnail' => $service->thumbnail_url,
                    'image' => $service->getImageUrl('md'),
                    'is_available' => $service->isAvailable(),
                    'specialists_count' => $service->specialists_count,
                    'discount' => [
                        'has_discount' => $service->hasDiscount(),
                        'discount_percentage' => $service->discount_percentage,
                        'original_price' => $service->original_price,
                    ],
                ];
            }),
            'meta' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                'has_more_pages' => $this->hasMorePages(),
            ],
            'links' => [
                'first' => $this->url(1),
                'last' => $this->url($this->lastPage()),
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'timestamp' => now()->toIso8601String(),
        ];
    }
} 