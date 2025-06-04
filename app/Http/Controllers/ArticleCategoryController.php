<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function update(Request $request)
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate(
            [
                'article_id' => 'required|exists:articles,id',
                'category_ids' => 'required|array',
                'category_ids.*' => 'integer|exists:categories,id',
            ]
        );

        $article = Article::findOrFail($validated['article_id']);

        $article->categories()->sync($validated['category_ids']);

        return response()->json(['message' => 'Categories added successfully'], 201);
    }

}
