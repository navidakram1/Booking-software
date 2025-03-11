<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CustomerHistory extends Model
{
    protected $fillable = [
        'customer_id',
        'historyable_type',
        'historyable_id',
        'action',
        'details'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_id');
    }

    public function historyable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function log(
        CustomerProfile $customer,
        string $action,
        Model $related = null,
        array $details = []
    ): self {
        $history = new self([
            'customer_id' => $customer->id,
            'action' => $action,
            'details' => $details
        ]);

        if ($related) {
            $history->historyable()->associate($related);
        }

        $history->save();
        return $history;
    }

    public function getFormattedDetails(): string
    {
        if (empty($this->details)) {
            return '';
        }

        return collect($this->details)
            ->map(fn($value, $key) => ucfirst(str_replace('_', ' ', $key)) . ': ' . $value)
            ->implode(', ');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('historyable_type', $type);
    }

    public function scopeWithAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
} 