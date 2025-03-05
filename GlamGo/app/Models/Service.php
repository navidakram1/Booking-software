<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'category_id',
        'image_url',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Get the category that owns the service.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all appointments for this service.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get all specialists who can provide this service.
     */
    public function specialists(): BelongsToMany
    {
        return $this->belongsToMany(Specialist::class);
    }

    // Scope for active services
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
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

    // Get formatted price
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    // Get formatted duration
    public function getFormattedDurationAttribute()
    {
        return $this->duration . ' min';
    }
}
