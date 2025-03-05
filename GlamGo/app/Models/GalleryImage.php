<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'caption',
        'display_order'
    ];

    protected $casts = [
        'display_order' => 'integer'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }
}
