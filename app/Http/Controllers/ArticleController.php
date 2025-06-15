<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Models\Follow;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): jsonResponse
    {
        // $articles = Article::with(['likes','comments'])->paginate(10);
        // return response()->json(ArticleResource::collection($articles));

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $articles = Article::with(['likes', 'comments'])
            ->orderBy('article_id', 'asc')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => ArticleResource::collection($articles),
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ],
        ]);
    }

    /**
     * Display a listing of the articles from users that the specified user follows.
     */
    public function followingArticle(string $userId, Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        // Get ALL users that the current user follows (no pagination on follows)
        $followingIds = Follow::where('follower_id', $userId)
              ->pluck('following_id');

        // Get articles from all followed users with pagination
        $articles = Article::with(['likes', 'comments', 'user'])
            ->whereIn('user_id', $followingIds)
            ->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => ArticleResource::collection($articles),
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ],
        ]);
    }
    /**
     * Display trending articles.
     */
    public function getTrending(Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $articles = Article::with(['likes', 'comments'])
            ->orderBy('view_count', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => ArticleResource::collection($articles),
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreArticleRequest $request): JsonResponse
    {
        $article = Article::create([
            'title' => $request->validated('title'),
            'subtitle' => $request->validated('subtitle'),
            'content' => $request->validated('content'),
            'image' => $request->validated('image'),
            'status' => $request->validated('status'),
            'view_count' => 0,
            'user_id' => auth()->id(),
        ]);

        return response()->json(new ArticleResource($article), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $article = Article::with(['likes', 'comments'])->findOrFail($id);

        $viewed = session()->get('viewed_articles', []);

        if (!in_array($id, $viewed)) {
            //increase view count of that article
            $article->increment('view_count');
            session()->push('viewed_articles', $id);
        }
        //return the article with likes and comments
        return response()->json(new ArticleResource($article));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage and use Request/Article/UpdateArticelRequest.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        // $article = Article::findOrFail($id);
        // $article->update($request->validated());

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $article = Article::findOrFail($id);
        $article->update($validated);

        return response()->json(new ArticleResource($article), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Article::findOrFail($id)->delete();
        return response()->json(['message' => 'Article deleted successfully'], 204);
    }
}
