<?php

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

// CSRF Token endpoint for testing with Postman
// Route::get('csrf-token', function () {
//     return response()->json(['csrf_token' => csrf_token()]);
// })->middleware('web');

// // Auth check endpoint for debugging
// Route::get('auth-check', function () {
//     return response()->json([
//         'authenticated' => auth()->check(),
//         'user_id' => auth()->id(),
//         'user' => auth()->user(),
//         'session_id' => session()->getId()
//     ]);
// })->middleware('web');

// // Temporary login endpoint for testing (remove in production)
// Route::post('test-login', function (Request $request) {
//     $request->validate(['email' => 'required|email']);

//     $user = \App\Models\User::where('email', $request->email)->firSst();

//     if ($user) {
//         Auth::login($user);
//         return response()->json([
//             'message' => 'Logged in successfully',
//             'user' => $user,
//             'csrf_token' => csrf_token()
//         ]);
//     }

//     return response()->json(['error' => 'User not found'], 404);
// })->middleware('web');


// Article Routes - using apiResource
// Route::apiResource('articles', ArticleController::class);

// Public routes (no authentication needed)
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show']);

// Protected routes (authentication required)
Route::middleware(['auth:sanctum'])->prefix('articles')->group(function () {
  Route::post('/', [ArticleController::class, 'store']);
  Route::put('/{article}', [ArticleController::class, 'update']);
  Route::delete('/{article}', [ArticleController::class, 'destroy']);
});

// Follow Routes

Route::apiResource('follows', FollowController::class)
    ->middleware('auth:sanctum');
Route::middleware(['auth:sanctum'])->prefix('follows')->group(function () {
  Route::get('/getFollowers/{userId}', [FollowController::class, 'getFollowers']);
  Route::get('/getFollowing/{userId}', [FollowController::class, 'getFollowing']);
});

// User
// Route::middleware(['auth:sanctum'])->prefix('users')->group(function () {
//     Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);
//     Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'show']);
// });
Route::get('users/', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/login', [UserController::class, 'login'])
    ->name('login');
Route::post('/auth/logout', [UserController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

// Comment Routes
Route::middleware(['auth:anctum'])->prefix('article/{article_id}')->group(function () {
    Route::get('/comments', [CommentController::class, 'index']);
    Route::get('comment/{id}', [CommentController::class, 'show']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::delete('comment/{id}', [CommentController::class, 'destroy']);
});

// Like Routes
Route::middleware(['auth:sanctum'])->prefix('article/{article_id}')->group(function () {
    Route::get('/likes', [LikeController::class, 'getArticleLikes']);
    Route::post('/like', [LikeController::class, 'toggleArticleLikes']);
});

Route::middleware(['auth:sanctum'])->prefix('comment/{comment_id}')->group(function () {
    Route::get('/likes', [LikeController::class, 'getCommentLikes']);
    Route::post('/like', [LikeController::class, 'toggleCommentLikes']);
});