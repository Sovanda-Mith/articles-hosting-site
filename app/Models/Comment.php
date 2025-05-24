<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $table = 'article_comments';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
    ];

    // relationships
    public function article(): BelongTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }
    public function user(): BelongTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
