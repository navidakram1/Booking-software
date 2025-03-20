namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'category' => $this->category,
            'price' => $this->price,
            'duration' => $this->duration,
            'rating' => $this->rating,
            'reviews_count' => $this->reviews_count,
            'is_featured' => $this->is_featured,
            'booking_count' => $this->booking_count,
            'images' => [
                'thumbnail' => $this->thumbnail_url,
                'small' => $this->getImageUrl('sm'),
                'medium' => $this->getImageUrl('md'),
                'large' => $this->getImageUrl('lg'),
                'original' => $this->image_url,
            ],
            'specialists' => SpecialistResource::collection($this->whenLoaded('specialists')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
            // Add computed properties
            'is_available' => $this->isAvailable(),
            'next_available_slot' => $this->whenLoaded('nextAvailableSlot'),
            'discount' => [
                'has_discount' => $this->hasDiscount(),
                'discount_percentage' => $this->discount_percentage,
                'original_price' => $this->original_price,
            ],
        ];
    }

    protected function getImageUrl($size)
    {
        return $this->{"image_url_{$size}"} ?? $this->image_url;
    }
} 