<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialist_id',
        'date',
        'start_time',
        'end_time',
        'is_available'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_available' => 'boolean'
    ];

    /**
     * Get the specialist that owns the time slot.
     */
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class);
    }
}
