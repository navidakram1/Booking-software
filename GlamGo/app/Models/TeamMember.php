<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'bio',
        'image',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
        'display_order',
        'status'
    ];

    protected $casts = [
        'display_order' => 'integer'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'team_member_services');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getSocialLinksAttribute()
    {
        return array_filter([
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin
        ]);
    }
}
