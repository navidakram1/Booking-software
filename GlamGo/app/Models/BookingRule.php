<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'conditions',
        'actions',
        'priority',
        'is_active',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'conditions' => 'array',
        'actions' => 'array',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];
}
