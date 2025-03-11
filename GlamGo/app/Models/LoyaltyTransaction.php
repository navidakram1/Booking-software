<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LoyaltyTransaction extends Model
{
    protected $fillable = [
        'customer_id',
        'points',
        'transaction_type',
        'description',
        'transactionable_type',
        'transactionable_id'
    ];

    protected $casts = [
        'points' => 'integer'
    ];

    const TYPE_EARNED = 'earned';
    const TYPE_REDEEMED = 'redeemed';
    const TYPE_EXPIRED = 'expired';
    const TYPE_ADJUSTED = 'adjusted';

    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_id');
    }

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getPointsDisplay(): string
    {
        $prefix = $this->points >= 0 ? '+' : '';
        return $prefix . number_format($this->points);
    }

    public function scopeEarned($query)
    {
        return $query->where('transaction_type', self::TYPE_EARNED);
    }

    public function scopeRedeemed($query)
    {
        return $query->where('transaction_type', self::TYPE_REDEEMED);
    }

    public function scopeExpired($query)
    {
        return $query->where('transaction_type', self::TYPE_EXPIRED);
    }

    public function scopeAdjusted($query)
    {
        return $query->where('transaction_type', self::TYPE_ADJUSTED);
    }

    public function scopePositive($query)
    {
        return $query->where('points', '>', 0);
    }

    public function scopeNegative($query)
    {
        return $query->where('points', '<', 0);
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
} 