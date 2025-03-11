<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffPerformanceMetric extends Model
{
    protected $fillable = [
        'staff_id',
        'date',
        'bookings_completed',
        'revenue_generated',
        'average_rating',
        'customer_satisfaction_score'
    ];

    protected $casts = [
        'date' => 'date',
        'bookings_completed' => 'integer',
        'revenue_generated' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'customer_satisfaction_score' => 'integer'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function calculateEfficiencyScore(): float
    {
        $weights = [
            'bookings' => 0.3,
            'revenue' => 0.3,
            'rating' => 0.2,
            'satisfaction' => 0.2
        ];

        $scores = [
            'bookings' => min(1, $this->bookings_completed / 10),
            'revenue' => min(1, $this->revenue_generated / 1000),
            'rating' => $this->average_rating ? ($this->average_rating / 5) : 0,
            'satisfaction' => $this->customer_satisfaction_score ? ($this->customer_satisfaction_score / 100) : 0
        ];

        return array_sum(array_map(
            fn($key) => $scores[$key] * $weights[$key],
            array_keys($weights)
        )) * 100;
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('date', now()->month)
            ->whereYear('date', now()->year);
    }

    public function scopeLastMonth($query)
    {
        $lastMonth = now()->subMonth();
        return $query->whereMonth('date', $lastMonth->month)
            ->whereYear('date', $lastMonth->year);
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    public function getPerformanceLevel(): string
    {
        $score = $this->calculateEfficiencyScore();
        
        if ($score >= 90) return 'Exceptional';
        if ($score >= 80) return 'Excellent';
        if ($score >= 70) return 'Good';
        if ($score >= 60) return 'Satisfactory';
        return 'Needs Improvement';
    }
} 