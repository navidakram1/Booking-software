<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'profile_image',
        'specialization',
        'years_of_experience',
        'is_active'
    ];

    protected $casts = [
        'years_of_experience' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Get all appointments for this specialist.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get all services this specialist can provide.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * Get all working hours for this specialist.
     */
    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }
}
