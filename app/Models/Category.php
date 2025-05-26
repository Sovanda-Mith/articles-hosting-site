<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    //relationships
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_categories', 'category_id', 'article_id');
    }
}
