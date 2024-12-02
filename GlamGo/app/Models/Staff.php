<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Booking;
use App\Models\Service;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'specialization',
        'profile_image',
        'working_hours',
        'is_active'
    ];

    protected $casts = [
        'working_hours' => 'array',
        'is_active' => 'boolean'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
