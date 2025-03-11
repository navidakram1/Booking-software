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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingStatusChanged;
use App\Notifications\BookingRescheduled;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'service_id',
        'staff_id',
        'start_time',
        'end_time',
        'status',
        'total_amount',
        'payment_status',
        'notes',
        'cancellation_reason',
        'rescheduled_from',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'rescheduled_from' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'created_at',
        'updated_at'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_NO_SHOW = 'no_show';
    const STATUS_RESCHEDULED = 'rescheduled';

    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_PARTIALLY_PAID = 'partially_paid';
    const PAYMENT_REFUNDED = 'refunded';
    const PAYMENT_FAILED = 'failed';

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

    public function originalBooking()
    {
        return $this->belongsTo(Booking::class, 'rescheduled_from');
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
        return $query->where('start_time', '>', Carbon::now())
            ->whereIn('status', [self::STATUS_PENDING, self::STATUS_CONFIRMED]);
    }

    public function scopePast($query)
    {
        return $query->where('start_time', '<', Carbon::now());
    }

    public function scopeToday($query)
    {
        return $query->whereDate('start_time', Carbon::today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('start_time', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('start_time', Carbon::now()->month)
            ->whereYear('start_time', Carbon::now()->year);
    }

    public function scopeBySpecialist($query, $specialistId)
    {
        return $query->where('staff_id', $specialistId);
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
        return $this->end_time->diffInMinutes($this->start_time);
    }

    public function isOverlapping(): bool
    {
        return static::where('staff_id', $this->staff_id)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhere(function ($q) {
                        $q->where('start_time', '<=', $this->start_time)
                            ->where('start_time', '>=', $this->end_time->copy()->addMinutes($this->getDurationInMinutes()));
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
            && $this->start_time > Carbon::now();
    }

    public function canBeRescheduled(): bool
    {
        return !in_array($this->status, [
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
            self::STATUS_NO_SHOW,
            self::STATUS_RESCHEDULED
        ]);
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

    public function getFormattedStartTimeAttribute()
    {
        return $this->start_time ? $this->start_time->format('M d, Y h:i A') : null;
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_time ? $this->end_time->format('M d, Y h:i A') : null;
    }

    public function getFormattedDurationAttribute()
    {
        return $this->getDurationInMinutes() . ' minutes';
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
        return $this->start_time > Carbon::now();
    }

    public function isPast()
    {
        return $this->start_time < Carbon::now();
    }

    public function updateStatus(string $status, ?string $reason = null): void
    {
        $oldStatus = $this->status;
        $this->status = $status;
        
        if ($reason) {
            $this->cancellation_reason = $reason;
        }
        
        $this->save();

        if ($oldStatus !== $status) {
            $this->sendStatusNotification($oldStatus, $status);
        }
    }

    public function reschedule(string $newStartTime, string $newEndTime): Booking
    {
        $newBooking = $this->replicate();
        $newBooking->start_time = $newStartTime;
        $newBooking->end_time = $newEndTime;
        $newBooking->status = self::STATUS_CONFIRMED;
        $newBooking->rescheduled_from = $this->id;
        $newBooking->save();

        $this->updateStatus(self::STATUS_RESCHEDULED);

        $this->sendRescheduleNotification($newBooking);

        return $newBooking;
    }

    protected function sendStatusNotification(string $oldStatus, string $newStatus): void
    {
        $notification = new BookingStatusChanged($this, $oldStatus, $newStatus);
        
        $this->customer->notify($notification);
        
        $this->staff->notify($notification);
        
        Notification::route('mail', config('mail.admin_email'))
            ->notify($notification);
    }

    protected function sendRescheduleNotification(Booking $newBooking): void
    {
        $notification = new BookingRescheduled($this, $newBooking);
        
        $this->customer->notify($notification);
        
        $this->staff->notify($notification);
        
        Notification::route('mail', config('mail.admin_email'))
            ->notify($notification);
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_NO_SHOW => 'No Show',
            self::STATUS_RESCHEDULED => 'Rescheduled',
        ];
    }

    public static function getPaymentStatuses(): array
    {
        return [
            self::PAYMENT_PENDING => 'Pending',
            self::PAYMENT_PAID => 'Paid',
            self::PAYMENT_PARTIALLY_PAID => 'Partially Paid',
            self::PAYMENT_REFUNDED => 'Refunded',
            self::PAYMENT_FAILED => 'Failed',
        ];
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'bg-warning',
            self::STATUS_CONFIRMED => 'bg-info',
            self::STATUS_IN_PROGRESS => 'bg-primary',
            self::STATUS_COMPLETED => 'bg-success',
            self::STATUS_CANCELLED => 'bg-danger',
            self::STATUS_NO_SHOW => 'bg-dark',
            self::STATUS_RESCHEDULED => 'bg-secondary',
            default => 'bg-light'
        };
    }
}
