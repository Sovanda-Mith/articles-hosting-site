<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_category extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleCategoryFactory> */
    use HasFactory;

    protected $table = 'article_categories';
    protected $primaryKey = 'article_category_id';

    protected $fillable = [
        'article_id',
        'category_id',
    ];

}
