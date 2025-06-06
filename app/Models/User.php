<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'username',
        'bio',
        'pf_image',
        'gender',
        'is_admin',
        'role_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationships to likes
    */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function likedArticles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_likes', 'user_id', 'article_id');
    }

    /**
     * Relationships to comments
    */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function commentedArticles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_comments', 'user_id', 'article_id');
    }

    /**
     * Relationships to articles
    */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    /**
     * Relationships to follows
    */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }
}
