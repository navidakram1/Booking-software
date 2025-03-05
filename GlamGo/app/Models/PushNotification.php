<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'link',
        'schedule_at',
        'sent_at',
        'status',
        'recipient_count'
    ];

    protected $casts = [
        'schedule_at' => 'datetime',
        'sent_at' => 'datetime'
    ];

    public function segments()
    {
        return $this->belongsToMany(Segment::class);
    }
}
