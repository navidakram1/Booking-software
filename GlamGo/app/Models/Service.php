<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'duration',
        'price',
        'is_active',
        'max_participants',
        'image_url',
        'color_code',
        'sort_order'
    ];

    protected $casts = [
        'duration' => 'integer',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'max_participants' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Get the category that owns the service.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    /**
     * Get all bookings for this service.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all specialists who can provide this service.
     */
    public function specialists(): BelongsToMany
    {
        return $this->belongsToMany(Specialist::class);
    }

    /**
     * Get the appointments for the service.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function addons(): HasMany
    {
        return $this->hasMany(ServiceAddon::class);
    }

    public function specialOffers(): HasMany
    {
        return $this->hasMany(SpecialOffer::class);
    }

    public function getActiveSpecialOffer()
    {
        return $this->specialOffers()
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->where('is_active', true)
            ->first();
    }

    public function getDiscountedPrice(): float
    {
        $specialOffer = $this->getActiveSpecialOffer();
        if (!$specialOffer) {
            return $this->price;
        }

        if ($specialOffer->discount_type === 'percentage') {
            return $this->price * (1 - ($specialOffer->discount_value / 100));
        }

        return max(0, $this->price - $specialOffer->discount_value);
    }

    public function getFormattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getFormattedDuration(): string
    {
        return $this->duration . ' minutes';
    }

    public function getFormattedDiscountedPrice(): string
    {
        return '$' . number_format($this->getDiscountedPrice(), 2);
    }

    public function hasActiveDiscount(): bool
    {
        return $this->getActiveSpecialOffer() !== null;
    }

    public function getDiscountPercentage(): ?int
    {
        $specialOffer = $this->getActiveSpecialOffer();
        if (!$specialOffer || $specialOffer->discount_type !== 'percentage') {
            return null;
        }

        return (int) $specialOffer->discount_value;
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include services in a specific category.
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope for price range
    public function scopePriceRange($query, $range)
    {
        return match ($range) {
            'low' => $query->where('price', '<', 50),
            'medium' => $query->whereBetween('price', [50, 100]),
            'high' => $query->where('price', '>', 100),
            default => $query,
        };
    }

    // Scope for duration range
    public function scopeDurationRange($query, $range)
    {
        return match ($range) {
            'short' => $query->where('duration', '<', 30),
            'medium' => $query->whereBetween('duration', [30, 60]),
            'long' => $query->where('duration', '>', 60),
            default => $query,
        };
    }

    // Search scope
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('category_id', 'like', "%{$search}%");
        });
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeWithActiveDiscounts($query)
    {
        return $query->whereHas('specialOffers', function ($q) {
            $q->where('start_date', '<=', Carbon::now())
              ->where('end_date', '>=', Carbon::now())
              ->where('is_active', true);
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
                    ->orderBy('name', 'asc');
    }
}
