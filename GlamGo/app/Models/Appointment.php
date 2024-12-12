<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;

class Appointment extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'staff_id',
        'appointment_date',
        'status',
        'notes',
        'total_amount'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'total_amount' => 'decimal:2'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
