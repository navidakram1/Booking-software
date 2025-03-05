<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'endpoint',
        'auth_token',
        'public_key',
        'user_id',
        'device_type',
        'last_active_at'
    ];

    protected $casts = [
        'last_active_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function segments()
    {
        return $this->belongsToMany(Segment::class);
    }
}
