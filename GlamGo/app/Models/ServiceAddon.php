<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAddon extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'service_id',
        'duration',
        'is_active'
    ];

    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
        'is_active' => 'boolean'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
