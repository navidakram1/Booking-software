<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Appointment;
use App\Models\Service;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

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
     * Get the appointments for the staff member.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_staff');
    }
}
