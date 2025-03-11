<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'date_of_birth',
        'gender',
        'preferences',
        'communication_preferences',
        'loyalty_points',
        'loyalty_tier'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'preferences' => 'array',
        'communication_preferences' => 'array',
        'loyalty_points' => 'integer'
    ];

    const TIER_BRONZE = 'bronze';
    const TIER_SILVER = 'silver';
    const TIER_GOLD = 'gold';
    const TIER_PLATINUM = 'platinum';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function history(): MorphMany
    {
        return $this->morphMany(CustomerHistory::class, 'historyable');
    }

    public function loyaltyTransactions(): HasMany
    {
        return $this->hasMany(LoyaltyTransaction::class, 'customer_id');
    }

    public function addLoyaltyPoints(int $points, string $reason): void
    {
        $this->loyalty_points += $points;
        $this->updateLoyaltyTier();
        $this->save();

        $this->loyaltyTransactions()->create([
            'points' => $points,
            'transaction_type' => 'earned',
            'description' => $reason
        ]);
    }

    public function deductLoyaltyPoints(int $points, string $reason): bool
    {
        if ($this->loyalty_points < $points) {
            return false;
        }

        $this->loyalty_points -= $points;
        $this->updateLoyaltyTier();
        $this->save();

        $this->loyaltyTransactions()->create([
            'points' => -$points,
            'transaction_type' => 'redeemed',
            'description' => $reason
        ]);

        return true;
    }

    public function updateLoyaltyTier(): void
    {
        $this->loyalty_tier = match(true) {
            $this->loyalty_points >= 5000 => self::TIER_PLATINUM,
            $this->loyalty_points >= 2500 => self::TIER_GOLD,
            $this->loyalty_points >= 1000 => self::TIER_SILVER,
            default => self::TIER_BRONZE
        };
    }

    public function getAge(): ?int
    {
        return $this->date_of_birth?->age;
    }

    public function getTotalSpent(): float
    {
        return $this->bookings()
            ->completed()
            ->sum('total_amount');
    }

    public function getAverageBookingValue(): float
    {
        $completedBookings = $this->bookings()->completed();
        $totalAmount = $completedBookings->sum('total_amount');
        $count = $completedBookings->count();

        return $count > 0 ? $totalAmount / $count : 0;
    }

    public function getPreferredServices(): array
    {
        return $this->bookings()
            ->completed()
            ->with('service')
            ->get()
            ->groupBy('service_id')
            ->map(fn($bookings) => [
                'service' => $bookings->first()->service,
                'count' => $bookings->count()
            ])
            ->sortByDesc('count')
            ->values()
            ->toArray();
    }
} 