<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'capacity',
        'price',
        'image',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'capacity' => 'integer',
        'price' => 'decimal:2'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'event_services');
    }

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class, 'event_team_members');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getIsUpcomingAttribute()
    {
        return $this->start_date > now();
    }

    public function getIsOngoingAttribute()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    public function getIsPastAttribute()
    {
        return $this->end_date < now();
    }

    public function getAvailableSpotsAttribute()
    {
        if (!$this->capacity) {
            return null;
        }
        return $this->capacity - $this->registrations()->count();
    }

    public function getIsFullAttribute()
    {
        if (!$this->capacity) {
            return false;
        }
        return $this->available_spots <= 0;
    }
}
