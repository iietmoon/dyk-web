<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'status',
        'published_at',
        'topics',
        'meta',
        'is_featured',
        'sort_order',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'topics' => 'array',
            'meta' => 'array',
            'is_featured' => 'boolean',
            'view_count' => 'integer',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the bookmarks for this article.
     *
     * @return HasMany<ArticleBookmark, $this>
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(ArticleBookmark::class);
    }
}
