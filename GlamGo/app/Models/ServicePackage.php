<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'is_active',
        'discount_percentage',
        'validity_days'
    ];

    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
        'is_active' => 'boolean',
        'discount_percentage' => 'float',
        'validity_days' => 'integer'
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_package_services');
    }

    /**
     * Get the total regular price of all services.
     */
    public function getRegularPriceAttribute()
    {
        return $this->services->sum('price');
    }

    /**
     * Get the savings amount.
     */
    public function getSavingsAttribute()
    {
        return $this->regular_price - $this->price;
    }

    /**
     * Get the savings percentage.
     */
    public function getSavingsPercentageAttribute()
    {
        if ($this->regular_price > 0) {
            return round(($this->savings / $this->regular_price) * 100, 1);
        }
        return 0;
    }

    /**
     * Get the total duration of all services.
     */
    public function getTotalDurationAttribute()
    {
        return $this->services->sum('duration');
    }
}
