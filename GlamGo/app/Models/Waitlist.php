<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'service_id',
        'preferred_date',
        'preferred_time',
        'status',
        'notes',
        'contact_attempts',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
        'contact_attempts' => 'integer',
    ];

    protected $attributes = [
        'status' => 'waiting',
        'contact_attempts' => 0,
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
