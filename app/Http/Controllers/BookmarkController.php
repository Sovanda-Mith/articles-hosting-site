<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    // toggle bookmark for an article
    public function toggleBookmark(Request $request, $articleId)
    {
        try {
            $user = Auth::user();
            $article = Article::findOrFail($articleId);

            // Check if the article is already bookmarked
            $isBookmarked = $user->bookmarkedArticles()->where('article_id', $articleId)->exists();

            if ($isBookmarked) {
                // Remove bookmark
                $user->bookmarkedArticles()->detach($articleId);
                $message = 'Article removed from bookmarks.';
            } else {
                // Add bookmark
                $user->bookmarkedArticles()->attach($articleId);
                $message = 'Article bookmarked successfully.';
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            \Log::error('Error toggling bookmark: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // get articles bookmarked by the user
    public function getUserBookmarkedArticles()
    {
        try {
            $user = Auth::user();

            $articles = $user->bookmarkedArticles()
                            ->with(['author', 'categories']) // eager load relationships
                            ->paginate(10);

            return response()->json([
                'success' => true,
                'articles' => $articles
            ]);

        } catch (\Exception $e) {
            \Log::error('Error fetching bookmarked articles: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
