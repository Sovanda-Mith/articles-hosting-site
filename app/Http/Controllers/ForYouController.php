<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ForYouController extends Controller
{
    public function getForYouArticles(Request $request) : JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        // Get trending articles
        $trendingIds = Article::orderBy('view_count', 'desc')
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

            return array_merge($article->toArray(), [
                'score' => $score,
                'categories' => $articleCategoryNames,
                'likes_count' => $article->likes_count ?? 0,
                'comments_count' => $article->comments_count ?? 0,
                'user' => $article->user,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at
            ]);
        })->sortByDesc('score')->values();

        // $paginated = ($scored)->paginate($limit, ['*'], 'page', $page);
        $total = count($scored);
        $lastPage = max(ceil($total / $limit), 1); // Ensure at least 1 page
        $offset = ($page - 1) * $limit;
        $paginatedItems = array_slice($scored->toArray(), $offset, $limit);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Recommended articles retrieved successfully',
        //     'data' => [
        //         // 'current_page' => (int)$page,
        //         // 'last_page' => (int)$lastPage,
        //         // 'total' => $total,
        //         // 'per_page' => (int)$limit,
        //         'recommended_articles' => $scored,
        //         'trending_articles' => $trendingIds,
        //         'user_preferences' => [
        //             'preferred_categories' => $preferredCategories,
        //             'liked_categories' => $likedCategories,
        //             'bookmarked_categories' => $bookmarkedCategories
        //         ]
        //     ]
        // ]);
        return response()->json([
            'data' => $paginatedItems,
            'meta' => [
                'current_page' => (int)$page,
                'last_page' => (int)$lastPage,
                'total' => $total,
                'per_page' => (int)$limit
            ],
            'recommended_articles' => $scored,
            'trending_articles' => $trendingIds,
            'user_preferences' => [
                'preferred_categories' => $preferredCategories,
                'liked_categories' => $likedCategories,
                'bookmarked_categories' => $bookmarkedCategories
            ]
        ]);
    }
}