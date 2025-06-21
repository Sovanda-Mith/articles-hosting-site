<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ForYouController extends Controller
{
    public function getForYouArticles()
    {
        $user = Auth::user();
        
        // Get trending articles
        $trendingIds = Article::orderBy('view_count', 'desc')
            ->take(10)
            ->pluck('article_id')
            ->toArray();

        // Get user's preferred categories based on liked and bookmarked articles
        $likedCategories = $user->likedArticles()
            ->with('categories')
            ->get()
            ->flatMap(fn($article) => $article->categories->pluck('name'))
            ->unique()
            ->toArray();

        $bookmarkedCategories = $user->bookmarkedArticles()
            ->with('categories')
            ->get()
            ->flatMap(fn($article) => $article->categories->pluck('name'))
            ->unique()
            ->toArray();

        $preferredCategories = array_unique(array_merge($likedCategories, $bookmarkedCategories));

        // Get excluded article IDs
        $likedIds = $user->likedArticles->pluck('article_id')->toArray();
        $bookmarkedIds = $user->bookmarkedArticles->pluck('article_id')->toArray();
        $excludedIds = array_unique(array_merge($likedIds, $bookmarkedIds));

        // Get candidate articles
        $candidateArticles = Article::whereNotIn('article_id', $excludedIds)
            ->where(function ($query) use ($trendingIds, $preferredCategories) {
                $query->whereIn('article_id', $trendingIds);
                
                if (!empty($preferredCategories)) {
                    $query->orWhereHas('categories', function ($q) use ($preferredCategories) {
                        $q->whereIn('name', $preferredCategories);
                    });
                }
            })
            ->with(['user', 'categories'])
            ->get();

        // Score articles
        $scored = $candidateArticles->map(function ($article) use (
            $trendingIds, 
            $preferredCategories, 
            $likedCategories,
            $bookmarkedCategories
        ) {
            $score = 0;
            
            $articleCategoryNames = $article->categories->pluck('name')->toArray();
        
            // 1. Liked categories 
            if (!empty(array_intersect($articleCategoryNames, $likedCategories))) {
                $score += 8;
            }
        
            // 2. Bookmarked categories 
            if (!empty(array_intersect($articleCategoryNames, $bookmarkedCategories))) {
                $score += 7;
            }
        
            // 3. Trending bonus
            if (in_array($article->article_id, $trendingIds, true)) {
                $score += 5;
            }

            return [
                'article_id' => $article->article_id,
                'title' => $article->title,
                'score' => $score,
                'categories' => $articleCategoryNames
            ];
        })->sortByDesc('score')->values();

        return response()->json([
            'success' => true,
            'message' => 'Recommended articles retrieved successfully',
            'data' => [
                'recommended_articles' => $scored,
                'trending_articles' => $trendingIds,
                'user_preferences' => [
                    'preferred_categories' => $preferredCategories,
                    'liked_categories' => $likedCategories,
                    'bookmarked_categories' => $bookmarkedCategories
                ]
            ]
        ]);
    
    }
}