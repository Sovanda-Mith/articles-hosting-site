<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Requests\Article\StoreArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): jsonResponse
    {
      $articles = Article::with(['likes','comments'])->paginate(10);
      return response()->json(ArticleResource::collection($articles));
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
    // public function store(Request $request): JsonResponse
    // {
    //   $validated = $request->validate([
    //     'title' => 'required|string|max:255',
    //     'subtitle' => 'nullable|string|max:255',
    //     'content' => 'required|string',
    //     'image' => 'nullable|image|max:2048',
    //     'status' => 'required|in:draft,published',
    //   ]);

    //   $validated['user_id'] = auth()->id();
    //   $article = Article::create($validated);

    //   return response()->json(new ArticleResource($article), 201);
    // }

    public function store(StoreArticleRequest $request): JsonResponse
    {
      $validated = $request->validated();
      $validated['user_id'] = auth()->id();

      $article = Article::create($validated);

      return response()->json(new ArticleResource($article), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $article = Article::with(['likes', 'comments'])->findOrFail($id);

        //increase view count of that article
        $article->increment('view_count');
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
