<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPoint extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'type', // earned or redeemed
        'reason'
    ];

    protected $casts = [
        'points' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
