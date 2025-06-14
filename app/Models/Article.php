<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'article_id';

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image',
        'status',
        'user_id',
        'view_count',
        'image',
        'status',
    ];

    // relationships
    /**
     * Relationships to Likes
    */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'article_id', 'article_id');
    }

    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'article_likes', 'article_id', 'user_id');
    }

    /**
     * Relationships to comments
    */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }
    public function commentedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'article_comments', 'article_id', 'user_id');
    }

    /**
     * Relationships to categories
    */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_categories', 'article_id', 'category_id');
    }
    /**
     * Relationships to user
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationships to bookmarks
    */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class, 'article_id', 'article_id');
    }
    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'article_bookmarks', 'article_id', 'user_id');
    }
}
