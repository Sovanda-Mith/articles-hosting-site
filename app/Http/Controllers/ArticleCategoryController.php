<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function update(Request $request)
    {
        /*
            if (!auth()->user()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        */

        $validated = $request->validate(
            [
                'article_id' => 'required|exists:articles,article_id',
                'category_ids' => 'required|array',
                'category_ids.*' => 'integer|exists:categories,category_id',
            ]
        );

        $article = Article::where('article_id', $validated['article_id'])->firstOrFail();

        $article->categories()->sync($validated['category_ids']);

        return response()->json(['message' => 'Categories updated successfully', 'redirect' => '/profile'], 200);
    }

}
