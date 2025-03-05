<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'number_of_people',
        'preferred_date',
        'preferred_time',
        'service_id',
        'staff_id',
        'status',
        'special_requests',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
        'number_of_people' => 'integer',
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
