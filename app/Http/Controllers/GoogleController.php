<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // dd('Method reached'); // Check if this method is being called
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Create a new user if not exist
            $user = User::updateOrCreate([
              'google_id' => $googleUser->id,
            ], [
              'name' => $googleUser->name,
              'email' => $googleUser->email,
              'password' => bcrypt(Str::random(16)), // Generate a random password
            ]);

            // Log the user in
            // Auth::login($user);

            // // Redirect to home or dashboard
            // return redirect('/');
            dd($user);

        } catch (\Exception $e) {
            // Handle error
            \Log::error('Google OAuth error: ' . $e->getMessage());
            // Redirect back with error message
            return redirect('/')->with('error', 'Failed to authenticate with Google. Please try again.');
        }

        // Redirect or return a response
    }
}
