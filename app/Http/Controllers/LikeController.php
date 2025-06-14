<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getIsLiked(string $article_id): JsonResponse
    {
        $user = Auth::id();

        $article = Article::findOrFail($article_id);

        $isLiked = $article->likes()->where('user_id', $user)->exists();

        return response()->json([
          'is_liked' => $isLiked
        ]);

    }

    /**
     * Toggle like for an article.
     */
    public function toggleArticleLike(string $article_id): JsonResponse
    {
        $user = Auth::id();

        $article = Article::findOrFail($article_id);

        // Check if the user has already liked the article
        $existingLike = Like::where([
            'user_id' => $user,
            'article_id' => $article_id,
        ])->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $action = 'unliked';
        } else {
            // Like
            Like::create([
                'user_id' => $user,
                'article_id' => $article_id,
            ]);
            $action = 'liked';
        }

        // Get updated counts
        $likesCount = $article->likes()->count();
        $isLiked = $action === 'liked';

        return response()->json([
            'success' => true,
            'action' => $action,
            'likes_count' => $likesCount,
            'is_liked' => $isLiked,
            'message' => 'Article ' . $action . ' successfully.',
        ]);
    }

    /**
     * Get the likes for an article.
     */
    public function getArticleLikes(string $article_id): JsonResponse
    {
        $article = Article::with('likes.user')->findOrFail($article_id);

        return response()->json([
            'article_id' => $article->article_id,
            'likes' => $article->likes,
            'likes_count' => $article->likes()->count(),
        ]);
    }

    /**
     * Toggle like for a comment.
     */
    public function toggleCommentLikes(Comment $comment): JsonResponse
    {
        $user = Auth::id();

        // Check if the user has already liked the comment
        $existingLike = Like::where([
            'user_id' => $user,
            'comment_id' => $comment->comment_id,
        ])->first();
        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $action = 'unliked';
        } else {
            // Like
            Like::create([
                'user_id' => $user,
                'comment_id' => $comment->comment_id,
            ]);
            $action = 'liked';
        }

        // Get updated counts
        $likesCount = $comment->likes()->count();
        $isLiked = $action === 'liked';

        return response()->json([
            'success' => true,
            'action' => $action,
            'likes_count' => $likesCount,
            'is_liked' => $isLiked,
            'message' => 'Comment ' . $action . ' successfully.',
        ]);
    }

    /**
     * Get the likes for a comment.
     */
    public function getCommentLikes(Comment $comment): JsonResponse
    {
        $likes = Like::with('user:id,name')
            ->where('comment_id', $comment->comment_id)
            ->orderBy('created_at', 'desc')
            ->get(['like_id', 'user_id', 'created_at']);

        return response()->json([
            'success' => true,
            'likes' => $likes,
        ]);
    }
}
