<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffTimeOff extends Model
{
    protected $fillable = [
        'staff_id',
        'start_date',
        'end_date',
        'reason',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function approve(): void
    {
        $this->update(['status' => self::STATUS_APPROVED]);
    }

    public function reject(): void
    {
        $this->update(['status' => self::STATUS_REJECTED]);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_APPROVED &&
            now()->between($this->start_date, $this->end_date);
    }

    public function getDurationInDays(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeActive($query)
    {
        $now = now();
        return $query->where('status', self::STATUS_APPROVED)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }
} 