<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'rating',
        'review_text'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    /**
     * Get the appointment that owns the review.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
