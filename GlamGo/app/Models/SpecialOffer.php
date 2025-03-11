<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SpecialOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'discount_type',
        'discount_value',
        'valid_from',
        'valid_until',
        'conditions',
        'is_active'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'conditions' => 'array',
        'is_active' => 'boolean'
    ];

    const DISCOUNT_TYPE_FIXED = 'fixed';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withTimestamps();
    }

    public function isValid(): bool
    {
        $now = now();
        return $this->is_active &&
            $now->greaterThanOrEqualTo($this->valid_from) &&
            $now->lessThanOrEqualTo($this->valid_until);
    }

    public function calculateDiscountedPrice(float $originalPrice): float
    {
        if ($this->discount_type === 'percentage') {
            return $originalPrice * (1 - ($this->discount_value / 100));
        }
        return max(0, $originalPrice - $this->discount_value);
    }

    public function getFormattedDiscount(): string
    {
        if ($this->discount_type === self::DISCOUNT_TYPE_PERCENTAGE) {
            return $this->discount_value . '%';
        }

        return '$' . number_format($this->discount_value, 2);
    }

    public function getFormattedDateRange(): string
    {
        return $this->valid_from->format('M d, Y') . ' - ' . $this->valid_until->format('M d, Y');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeValid($query)
    {
        $now = now();
        return $query->where('is_active', true)
            ->where('valid_from', '<=', $now)
            ->where('valid_until', '>=', $now);
    }

    public function scopeExpired($query)
    {
        return $query->where('valid_until', '<', Carbon::now());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('valid_from', '>', Carbon::now());
    }

    public function scopeForService($query, $serviceId)
    {
        return $query->whereHas('services', function ($q) use ($serviceId) {
            $q->where('service_id', $serviceId);
        });
    }
} 