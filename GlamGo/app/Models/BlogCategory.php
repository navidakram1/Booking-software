<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPostCount(): int
    {
        return $this->posts()->published()->count();
    }

    public function scopeWithPostCount($query)
    {
        return $query->withCount(['posts' => function ($query) {
            $query->published();
        }]);
    }

    public function scopeHasPosts($query)
    {
        return $query->whereHas('posts', function ($query) {
            $query->published();
        });
    }

    public function scopeOrderByPostCount($query, string $direction = 'desc')
    {
        return $query->withPostCount()
 