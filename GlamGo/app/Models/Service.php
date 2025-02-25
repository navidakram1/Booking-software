<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Booking;
use App\Models\Staff;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'category',
        'image'
    ];

    /**
     * Get all bookings for this service
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all staff members who can provide this service
     */
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_services');
    }

    /**
     * Get the formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Get the formatted duration
     */
    public function getFormattedDurationAttribute()
    {
        if ($this->duration < 60) {
            return $this->duration . ' min';
        }
        
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        if ($minutes === 0) {
            return $hours . ' hr' . ($hours > 1 ? 's' : '');
        }
        
        return $hours . ' hr ' . $minutes . ' min';
    }
}
