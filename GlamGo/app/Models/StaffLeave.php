<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'start_date',
        'end_date',
        'reason',
        'type',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
