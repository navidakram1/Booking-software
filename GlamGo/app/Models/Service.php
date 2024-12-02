<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'image_url',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'is_active' => 'boolean'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }
}
