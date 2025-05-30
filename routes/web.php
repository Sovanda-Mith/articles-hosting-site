<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

// Auth routes
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->name('google.callback');

// Catch-all route for SPA - must be last
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '(.*)');
