<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_cta_text',
        'hero_cta_link',
        'hero_image',
        'hero_video',
        'about_title',
        'about_content',
        'about_image',
        'about_video',
        'features',
        'stats'
    ];

    protected $casts = [
        'features' => 'array',
        'stats' => 'array'
    ];

    public function getHeroImageUrlAttribute()
    {
        return $this->hero_image ? Storage::url($this->hero_image) : null;
    }

    public function getHeroVideoUrlAttribute()
    {
        return $this->hero_video ? Storage::url($this->hero_video) : null;
    }

    public function getAboutImageUrlAttribute()
    {
        return $this->about_image ? Storage::url($this->about_image) : null;
    }

    public function getAboutVideoUrlAttribute()
    {
        return $this->about_video ? Storage::url($this->about_video) : null;
    }
}
