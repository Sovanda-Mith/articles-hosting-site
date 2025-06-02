<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GoogleController;

Route::get('/user', function (Request $request) {
    return $request->user();
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
