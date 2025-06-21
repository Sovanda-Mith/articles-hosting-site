<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Carbon\Carbon;
class ArticleAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $articles = Article::with(['likes', 'comments', 'user'])
        ->latest()
        ->get()
        ->map(function ($article) {
            return [
                'article_id'   => $article->article_id,
                'title'        => $article->title ?? 'Unknown',
                'subtitle'     => $article->subtitle,
                'content'      => $article->content ?? 'Null',
                'username'     => $article->user->name ?? 'Unknown',
                'pf_user'      => $article->user->pf_image ?? 'Null',
                'view_count'   => $article->view_count ?? 'N/A',
                'status'       => $article->status,
                'image'        => $article->image,
                'likes_count'  => $article->likes->count(),
                'comments_count' => $article->comments->count(),
                'issued_date'    => Carbon::parse($article->created_at)->diffForHumans(),
            ];
        });

        return response()->json($articles);
    }


}
