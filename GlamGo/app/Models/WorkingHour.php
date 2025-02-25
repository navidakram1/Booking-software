<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkingHour extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'specialist_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_day_off'
    ];

    protected $casts = [
        'day_of_week' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_day_off' => 'boolean'
    ];

    /**
     * Get the specialist that owns the working hours.
     */
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class);
    }
}
