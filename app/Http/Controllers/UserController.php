<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'email' => $user->email,
                'username' => $user->username,
                'bio' => $user->bio,
                'role' => $user->role_id == 1 ? 'user' : 'admin',
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ];
        });

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Debug: Check what data is being received
        \Log::info('Validated data:', $validated);

        $user = $this->createNewUser($validated);

        return response()->json(new UserResource($user), 201);
    }

    public function createNewUser(array $data): User
    {
        // Generate initial username from name
        $baseUsername = Str::slug($data['name']);
        $username = $baseUsername . '#' . Str::random(4);

        // Check if username exists and keep trying until we find a unique one
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '#' . Str::random(4);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $username,
            'password' => bcrypt($data['password']),
            'bio' => $data['bio'] ?? null,
            'role_id' => $data['role_id'] ?? 1, // Default to user role if not provided
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'message' => 'User found',
            'data' => [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'username' => $user->username,
                'bio' => $user->bio,
                'avatar' => $user->pf_image,
                'gender' => $user->gender,
                'role' => $user->role_id == 1 ? 'user' : 'admin',
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ]
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Debug: Check what data is being received
        // \Log::info('Login request data:', $validated);

        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials. Wrong email or password.',
            ], 401);
        }


        // Create Sanctum token for API authentication
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
          'message' => 'Login successful',
          'user' => [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'username' => $user->username,
            'bio' => $user->bio,
            'avatar' => $user->pf_image,
            'gender' => $user->gender,
            'role' => $user->role_id == 1 ? 'user' : 'admin',
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
          ],
          'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        return response()->json([

            'message' => 'Logged out successfully'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
