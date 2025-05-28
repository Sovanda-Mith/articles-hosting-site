<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

          $googleUser = Socialite::driver('google')->stateless()->user();

          // Check if user already exists by email or google_id
          $existingUser = User::where('email', $googleUser->email)
                            ->orWhere('google_id', $googleUser->id)
                            ->first();

          if ($existingUser) {
              // Update existing user's Google ID if it's missing
              if (!$existingUser->google_id) {
                  $existingUser->update(['google_id' => $googleUser->id]);
              }
              $user = $existingUser;
          } else {
              // Create new user with all required fields
              $user = $this->createNewUser($googleUser);
          }
          
          dd($user);

            // Log the user in
            // Auth::login($user);

            // // Redirect to intended page or dashboard
            // return redirect()->intended('/dashboard')->with('success', 'Welcome! You have been logged in successfully.');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Google OAuth error: ' . $e->getMessage());

            // Redirect back with error message
            return redirect('/login')->with('error', 'Failed to authenticate with Google. Please try again.');
        }
    }

    // create new user
    public function createNewUser($googleUser)
    {
      // Generate initial username
      $baseUsername = Str::slug($googleUser->name);
      $username = $baseUsername . '#' . Str::random(5);

      // Check if username exists and keep trying until we find a unique one
      while (User::where('username', $username)->exists()) {
          $username = $baseUsername . '#' . Str::random(5);
      }

      $profileImagePath = null;
      if($googleUser->avatar) {
        $profileImagePath = $this->downloadGoogleProfileImage($googleUser->avatar, $username);
      }

      return User::create([
          'name' => $googleUser->name,
          'email' => $googleUser->email,
          'password' => Hash::make(Str::random(16)), // Generate a random password
          'google_id' => $googleUser->id,
          'username' => $username,
          'bio' => null,
          'pf_image' => $profileImagePath,
          'is_admin' => false,
      ]);
    }

    // download google profile image
    public function downloadGoogleProfileImage($url, $username)
    {
      try {
        $imageContent = file_get_contents($url);

        if($imageContent){
          $extension = 'jpg'; // Default to jpg
          $filename = 'google_'. $username . '_' . time() . '.' . $extension;
          $path= 'userPf/' . $filename;

          Storage::disk('public')->put('userPf/' . $filename, $imageContent);
          return $path;
        }
      } catch (\Exception $e) {
        \Log::error('Failed to download profile image: ' . $e->getMessage());
      }

      return null; // Return null if download fails
    }
}
