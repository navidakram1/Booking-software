<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'is_active'
    ];

    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
        'is_active' => 'boolean'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_package_services');
    }
}
