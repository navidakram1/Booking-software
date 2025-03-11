<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'staff_id',
        'service_id',
        'appointment_date',
        'total_amount',
        'status',
        'notes',
        'rating',
        'review'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'rating' => 'integer'
    ];

    /**
     * Get the customer that owns the appointment.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the staff member assigned to the appointment.
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Get the service for this appointment.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope a query to only include completed appointments.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include pending appointments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include cancelled appointments.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to only include confirmed appointments.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Get the formatted status.
     */
    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->status);
    }

    /**
     * Get the formatted appointment date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->appointment_date->format('M d, Y g:i A');
    }

    /**
     * Get the formatted total amount.
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->total_amount, 2);
    }

    /**
     * Get the review for this appointment.
     */
    public function review(): HasOne
    {
        return $this->hasOne(ServiceReview::class);
    }
}
