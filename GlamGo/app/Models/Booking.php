<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Staff;

class Booking extends Model
{
    protected $fillable = [
        'service_id',
        'specialist_id',
        'customer_id',
        'start_time',
        'end_time',
        'status',
        'total_price',
        'customer_details',
        'notes',
        'confirmation_code',
        'timezone',
        'payment_status',
        'addons'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'customer_details' => 'array',
        'addons' => 'array',
        'total_price' => 'decimal:2'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_NO_SHOW = 'no_show';

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_REFUNDED = 'refunded';

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function addons(): HasMany
    {
        return $this->hasMany(ServiceAddon::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now())
                    ->whereNotIn('status', [self::STATUS_CANCELLED, self::STATUS_COMPLETED]);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('start_time', Carbon::today())
                    ->whereNotIn('status', [self::STATUS_CANCELLED]);
    }

    public function scopeBySpecialist($query, $specialistId)
    {
        return $query->where('specialist_id', $specialistId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('start_time', [$startDate, $endDate]);
    }

    public function getDurationInMinutes(): int
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    public function isOverlapping(): bool
    {
        return static::where('specialist_id', $this->specialist_id)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                    ->orWhere(function ($q) {
                        $q->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                    });
            })
            ->whereNotIn('status', [self::STATUS_CANCELLED, self::STATUS_NO_SHOW])
            ->exists();
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED]) &&
               $this->start_time->isFuture();
    }

    public function canBeRescheduled(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED]) &&
               $this->start_time->isFuture();
    }

    public function getFormattedStatus(): string
    {
        return ucfirst($this->status);
    }

    public function getStatusColor(): string
    {
        return [
            self::STATUS_PENDING => '#FCD34D',    // Yellow
            self::STATUS_CONFIRMED => '#34D399',   // Green
            self::STATUS_COMPLETED => '#60A5FA',   // Blue
            self::STATUS_CANCELLED => '#F87171',   // Red
            self::STATUS_NO_SHOW => '#6B7280',     // Gray
        ][$this->status] ?? '#9CA3AF';
    }
}
