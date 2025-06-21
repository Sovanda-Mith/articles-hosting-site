<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForYouController extends Controller
{
    public function getForYouArticles()
    {
        $user = Auth::user();
    
        // Step 1: Get user interaction data, trending articles, and preferred categories
        $trendingIds = Article::orderBy('view_count', 'desc')->take(20)->pluck('article_id')->toArray();
        $preferredCategories = $user->preferred_categories; 

        $likedIds = $user->likedArticles()->pluck('articles.articles.id')->toArray();
        $bookmarkedIds = $user->bookmarkedArticles()->pluck('articles.articles.id')->toArray();
        $excludedIds = array_unique(array_merge($likedIds, $bookmarkedIds));
    
        \Log::info('Liked Article IDs:', $likedIds);
        \Log::info('Bookmarked Article IDs:', $bookmarkedIds);
        \Log::info('Excluded Article IDs:', $excludedIds);

        // Step 2: Generate candidate articles 
        $candidateArticles = Article::whereNotIn('article_id', $excludedIds)
            ->where(function ($query) use ($preferredCategories, $trendingIds) {
                $query->whereIn('article_id', $trendingIds)
                      ->orWhereIn('category', $preferredCategories);
            })
            ->with(['user', 'categories'])
            ->get();

        // Step 3: Score each article
        $scored = $candidateArticles->map(function ($article) use ($trendingIds, $preferredCategories, ) {
            $score = 0;
    
            if (in_array($article->category, $preferredCategories)) {
                $score += 10;
            }
           
            if (in_array($article->id, $trendingIds)) {
                $score += 5;
            }

            $article->score = $score;
            return $article;
        });
    
        // Step 4: Sort by score (descending)
        $sorted = $scored->sortByDesc('score')->values();
    
        // Step 5: Return to frontend (with pagination manually if needed)
        return response()->json([
            'success' => true,
            'articles' => $sorted->take(20), // take top 20
        ]);
    }
    
}