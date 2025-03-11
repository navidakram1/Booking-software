<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceAddon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'is_active' => 'boolean'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getFormattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getFormattedDuration(): string
    {
        return $this->duration . ' minutes';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
                    ->orderBy('name', 'asc');
    }

    public function scopeForService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_addon_compatibility', 'addon_id', 'service_id')
            ->withTimestamps();
    }

    public function isCompatibleWith(Service $service): bool
    {
        return $this->services()->where('service_id', $service->id)->exists();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
