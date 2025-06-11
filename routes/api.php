<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth verification endpoint
Route::get('/auth/verify', function (Request $request) {
    return response()->json([
        'valid' => true,
        'user' => $request->user()
    ]);
})->middleware('auth:sanctum');

// Public routes (no authentication needed)
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/trending', [ArticleController::class, 'getTrending']);
Route::get('articles/{article}', [ArticleController::class, 'show']);

// Settings Routes
Route::controller(SettingController::class)->prefix('settings')->group(
    function () {
        Route::get('/blockedUser', 'blockedUsers');
        Route::get('/mutedUser', 'mutedUsers');
        Route::post('/notification', 'updateNotificationSettings');
        Route::get('/download', 'downloadUserData');
    }
);

// Category Routes
Route::controller(CategoryController::class)->prefix('category')->group(
    function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    }
);

// Article Category Routes
Route::controller(ArticleCategoryController::class)->prefix('articleCategory')->group(
    function () {
        Route::post('/', 'update');
        Route::get('/{article}', 'show');
    }
);

// Upload Routes
Route::controller(UploadController::class)->prefix('upload')->group(
    function () {
        Route::post('/cover', 'uploadCover');
    }
);

// Route::post('articles/', [ArticleController::class, 'store']);
// Article Routes (Protected)
Route::prefix('articles')->group(function () {
    Route::post('/', [ArticleController::class, 'store']);
    Route::put('/{article}', [ArticleController::class, 'update']);
    Route::delete('/{article}', [ArticleController::class, 'destroy']);
    Route::get('/following/{userid}', [ArticleController::class, 'followingArticle']);

});

// Follow Routes
Route::apiResource('follows', FollowController::class)
    ->middleware('auth:sanctum');
Route::middleware(['auth:sanctum'])->prefix('follows')->group(function () {
    Route::get('/getFollowers/{userId}', [FollowController::class, 'getFollowers']);
    Route::get('/getFollowing/{userId}', [FollowController::class, 'getFollowing']);
    Route::post('/checkIfFollowing', [FollowController::class, 'checkIfFollowing']);
});

// User Routes
Route::get('users/', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/login', [UserController::class, 'login'])
    ->name('login');
Route::post('/auth/logout', [UserController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

// Comment Routes
Route::middleware(['auth:sanctum'])->prefix('article/{article_id}')->group(function () {
    Route::get('/comments', [CommentController::class, 'index']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::delete('comment/{id}', [CommentController::class, 'destroy']);
});

// Like Routes
Route::middleware(['auth:sanctum'])->prefix('article/{article_id}')->group(function () {
    Route::get('/isLiked', [LikeController::class, 'checkIsLiked']);
    Route::get('/likes', [LikeController::class, 'getArticleLikes']);
    Route::post('/like', [LikeController::class, 'toggleArticleLike']);
});

Route::middleware(['auth:sanctum'])->prefix('comment/{comment_id}')->group(function () {
    Route::get('/likes', [LikeController::class, 'getCommentLikes']);
    Route::post('/like', [LikeController::class, 'toggleCommentLikes']);
});
