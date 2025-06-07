<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role;
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

          // dd($user); // Commented out for production

          // Log the user in
          Auth::login($user);
          session()->regenerate();

          if (request()->expectsJson()) {
              // Create Sanctum token for API authentication
              $token = $user->createToken('Google OAuth Token')->plainTextToken;
              return response()->json([
                  'success' => true,
                  'message' => 'Login successful',
                  'user' => $user,
                  'token' => $token
              ]);
          } else {
              // For web, redirect to intended page
              return redirect()->intended('/feed');
          }

          // Redirect to intended page or dashboard
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
        if ($googleUser->avatar) {
            $profileImagePath = $this->downloadGoogleProfileImage($googleUser->avatar, $username);
        }

        // Get the user role ID dynamically
        $userRole = Role::where('name', 'user')->first();
        $roleId = $userRole ? $userRole->role_id : 1; // Fallback to 1 if role not found

        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make(Str::random(16)), // Generate a random password
            'google_id' => $googleUser->id,
            'username' => $username,
            'bio' => null,
            'pf_image' => $profileImagePath,
            'is_admin' => false,
            'role_id' => $roleId,
        ]);
    }

    // download google profile image
    public function downloadGoogleProfileImage($url, $username)
    {
        try {
            $imageContent = file_get_contents($url);

            if ($imageContent) {
                $extension = 'jpg'; // Default to jpg
                $filename = 'google_'. $username . '_' . time() . '.' . $extension;
                $path = 'userPf/' . $filename;

                Storage::disk('public')->put('userPf/' . $filename, $imageContent);
                return $path;
            }
        } catch (\Exception $e) {
            \Log::error('Failed to download profile image: ' . $e->getMessage());
        }

        return null; // Return null if download fails
    }

    // API-specific methods for mobile/SPA applications
    public function apiRedirectToGoogle()
    {
        return response()->json([
            'redirect_url' => Socialite::driver('google')
                ->stateless()
                ->redirect()
                ->getTargetUrl()
        ]);
    }

    public function apiHandleGoogleCallback(Request $request)
    {
        try {
            // Use stateless for API
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Find or create user
            $user = User::updateOrCreate([
                'email' => $googleUser->email
            ], [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'email_verified_at' => now(),
            ]);

            // Create Sanctum token for API use
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Successfully authenticated'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Authentication failed',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
