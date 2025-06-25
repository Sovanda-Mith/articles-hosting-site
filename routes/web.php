<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Auth routes
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->name('google.callback');

// MinIO image proxy route
Route::get('/storage/minio/{path}', function ($path) {
    try {
        // Clean the path to prevent directory traversal
        $cleanPath = ltrim($path, '/');
        
        // Check if file exists in MinIO
        if (Storage::disk('minio')->exists($cleanPath)) {
            $file = Storage::disk('minio')->get($cleanPath);
            $mimeType = Storage::disk('minio')->mimeType($cleanPath);
            
            return response($file, 200)
                ->header('Content-Type', $mimeType)
                ->header('Cache-Control', 'public, max-age=3600');
        }
        
        return abort(404);
    } catch (Exception $e) {
        return abort(404);
    }
})->where('path', '.*');

// Catch-all route for SPA - must be last
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '(.*)');
