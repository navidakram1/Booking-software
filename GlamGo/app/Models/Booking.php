<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Staff;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_id',
        'staff_id',
        'scheduled_at',
        'duration',
        'status',
        'total_amount',
        'notes'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'duration' => 'integer'
    ];

    protected $dates = [
        'scheduled_at',
        'created_at',
        'updated_at'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_NO_SHOW = 'no_show';

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_REFUNDED = 'refunded';

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function addons(): HasMany
    {
        return $this->hasMany(ServiceAddon::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    public function scopeNoShow($query)
    {
        return $query->where('status', self::STATUS_NO_SHOW);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('scheduled_at', '>', Carbon::now())
            ->whereIn('status', [self::STATUS_PENDING, self::STATUS_CONFIRMED]);
    }

    public function scopePast($query)
    {
        return $query->where('scheduled_at', '<', Carbon::now());
    }

    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_at', Carbon::today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('scheduled_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('scheduled_at', Carbon::now()->month)
            ->whereYear('scheduled_at', Carbon::now()->year);
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
        return $query->whereBetween('scheduled_at', [$startDate, $endDate]);
    }

    public function getDurationInMinutes(): int
    {
        return $this->duration;
    }

    public function isOverlapping(): bool
    {
        return static::where('specialist_id', $this->specialist_id)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->whereBetween('scheduled_at', [$this->scheduled_at, $this->scheduled_at->copy()->addMinutes($this->duration)])
                    ->orWhereBetween('scheduled_at', [$this->scheduled_at, $this->scheduled_at->copy()->addMinutes($this->duration)])
                    ->orWhere(function ($q) {
                        $q->where('scheduled_at', '<=', $this->scheduled_at)
                            ->where('scheduled_at', '>=', $this->scheduled_at->copy()->addMinutes($this->duration));
                    });
            })
            ->whereNotIn('status', [self::STATUS_CANCELLED, self::STATUS_NO_SHOW])
            ->exists();
    }

    public function canBeModified(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED]);
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED]) 
            && $this->scheduled_at > Carbon::now();
    }

    public function canBeRescheduled(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED]) &&
               $this->scheduled_at->isFuture();
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

    public function getFormattedScheduledAtAttribute()
    {
        return $this->scheduled_at ? $this->scheduled_at->format('M d, Y h:i A') : null;
    }

    public function getFormattedDurationAttribute()
    {
        return $this->duration . ' minutes';
    }

    public function getFormattedTotalAmountAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed()
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isNoShow()
    {
        return $this->status === self::STATUS_NO_SHOW;
    }

    public function isUpcoming()
    {
        return $this->scheduled_at > Carbon::now();
    }

    public function isPast()
    {
        return $this->scheduled_at < Carbon::now();
    }
}
