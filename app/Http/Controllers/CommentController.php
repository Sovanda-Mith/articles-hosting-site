<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $article_id): JsonResponse
    {
        $article = Article::with('comments.user')->findOrFail($article_id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json([
            'article_id' => $article->article_id,
            'comments' => $article->comments,
            'comments_count' => $article->comments()->count()
      ]);
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
    public function store(StoreCommentRequest $request, string $article_id): JsonResponse
    {
        $validated = $request->validated();

        $article = Article::findOrFail($article_id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $comment = Comment::create([
          'content' => $validated['content'],
          'article_id' => $article_id,
          'user_id' => auth()->user()->id
        ]);

        $comment->load('user');

        return response()->json([
          'comment' => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        return response()->json($comment, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, string $article_id, string $id): JsonResponse
    {
        $comment = Comment::findOrFail($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $validated = $request->validated();
        $comment->update($validated);
        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $article_id, string $id): JsonResponse
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $comment->delete();
        return response()->json(['message' => 'Comment deleted'], 200);
    }
}
