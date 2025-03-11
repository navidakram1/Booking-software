<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'author_id',
        'featured_image',
        'tags',
        'status',
        'published_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime'
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getExcerpt(int $length = 150): string
    {
        return Str::limit(strip_tags($this->content), $length);
    }

    public function getTagsString(): string
    {
        return implode(', ', $this->tags ?? []);
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByTag($query, string $tag)
    {
        return $query->where('tags', 'like', "%$tag%");
    }

    public function scopeRecent($query, int $limit = 5)
    {
        return $query->published()
            ->orderBy('published_at', 'desc')
            ->limit($limit);
    }

    public function publish(): void
    {
        $this->update([
            'status' => self::STATUS_PUBLISHED,
            'published_at' => $this->published_at ?? now()
        ]);
    }

    public function unpublish(): void
    {
        $this->update([
            'status' => self::STATUS_DRAFT,
            'published_at' => null
        ]);
    }

    public function archive(): void
    {
        $this->update(['status' => self::STATUS_ARCHIVED]);
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED &&
            $this->published_at &&
            $this->published_at->isPast();
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isArchived(): bool
    {
        return $this->status === self::STATUS_ARCHIVED;
    }
} 