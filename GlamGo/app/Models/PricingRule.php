<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $fillable = [
        'name',
        'description',
        'service_id',
        'staff_id',
        'day_of_week',
        'start_time',
        'end_time',
        'discount_type',
        'discount_value',
        'priority',
        'is_active',
        'min_booking_value',
        'max_discount'
    ];

    protected $casts = [
        'day_of_week' => 'integer',
        'discount_value' => 'float',
        'priority' => 'integer',
        'is_active' => 'boolean',
        'min_booking_value' => 'float',
        'max_discount' => 'float'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
