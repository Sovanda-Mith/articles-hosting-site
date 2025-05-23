<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

// Auth routes
Route::get('/auth/google/redirect', function (Request $request){
  return Socialite::driver("google")->stateless()->redirect();
});

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// Route::get('/auth/google/callback', function (Request $request){
//   try {
//     // Use stateless to avoid the state validation
//     $googleUser = Socialite::driver('google')->stateless()->user();

//     $user = User::updateOrCreate([
//       'google_id' => $googleUser->id,
//     ], [
//       'name' => $googleUser->name,
//       'email' => $googleUser->email,
//       'password' => bcrypt(Str::random(16)), // Generate a random password
//     ]);

//     // Log the user in
//     // Auth::login($user);

//     // // Redirect to home or dashboard
//     // return redirect('/');
//     dd($user);
//   } catch (\Exception $e) {
//     // Log the error for debugging
//     \Log::error('Google OAuth error: ' . $e->getMessage());

//     // Redirect back with error message
//     return redirect('/')->with('error', 'Failed to authenticate with Google. Please try again.');
//   }
// });

// Catch-all route for SPA - must be last
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '(.*)');
