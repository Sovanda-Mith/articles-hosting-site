<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'gender' => $user->gender,
                'occupation' => $user->occupation,
                'bio' => $user->bio,
                'pf_image' => $user->pf_image,
                'role' => $user->role_id == 1 ? 'user' : 'admin',
                'is_allowed' => $user->is_allowed,
                'address_line' => $user->address_line,
                'city' => $user->city,
                'country' => $user->country,
                'phone_number' => $user->phone_number,
                'dob' => $user->dob,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
        });

        return response()->json($users);
    }
    public function delete($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // If user not found, return 404 response
        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        // Delete the user
        $user->delete();

        // Return success response
        return response()->json([
            'message' => 'User deleted successfully.'
        ], 200);
    }

    public function update(Request $request, $id)
     {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'username' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            // 'occupation' => 'nullable|string|max:255',
            // 'gender' => 'required|string|in:male,female',
            // 'phone_number' => 'nullable|string|max:20',
            // 'address_line' => 'nullable|string|max:255',
            // 'city' => 'nullable|string|max:100',
            // 'country' => 'nullable|string|max:100',
            // 'dob' => 'nullable|date',
            // 'bio' => 'nullable|string|max:1000',
            // 'is_allowed' => 'required|string|in:allowed,blocked',
            // 'avatar_base64' => 'nullable|string',
        ]);

        try {
            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->occupation = $request->occupation;
            $user->gender = $request->gender;
            $user->phone_number = $request->phone_number;
            $user->address_line = $request->address_line;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->dob = $request->dob;
            $user->bio = $request->bio;
            if ($request->is_allowed == "blocked")
            {
                $user->is_allowed = 0;
            }
            else
            {
                $user->is_allowed = 1;
            }
            

            // Upload pf_image if present
            if ($request->avatar_base64) {
                $base64String = $request->avatar_base64;

                if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
                    $extension = $matches[1];
                    $base64String = substr($base64String, strpos($base64String, ',') + 1);
                    $base64String = str_replace(' ', '+', $base64String);
                    $imageData = base64_decode($base64String);

                    if ($imageData === false) {
                        return response()->json(['message' => 'Invalid base64 image data'], 400);
                    }

                    $filename = 'avatars/' . \Str::uuid() . '.' . $extension;
                    $stored = Storage::disk('minio')->put($filename, $imageData);

                    if (!$stored) {
                        return response()->json(['message' => 'Failed to upload to MinIO'], 500);
                    }

                    $avatarUrl = Storage::disk('minio')->url($filename);
                    $user->pf_image = $avatarUrl;
                } else {
                    return response()->json(['message' => 'Invalid image format'], 400);
                }
            }

            $user->save();

            return response()->json([
                'message' => 'User updated successfully.',
                'user' => $user
            ], 200);

                } catch (ModelNotFoundException $e) {
                    return response()->json(['message' => 'User not found.'], 404);
                } catch (\Throwable $e) {
                    return response()->json([
                        'message' => 'Failed to update user.',
                        'error' => $e->getMessage(), // remove this line in production
                    ], 500);
                }

            }

    
    public function store(Request $request)
     {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'username' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            // 'occupation' => 'nullable|string|max:255',
            // 'gender' => 'required|string|in:male,female',
            // 'phone_number' => 'nullable|string|max:20',
            // 'address_line' => 'nullable|string|max:255',
            // 'city' => 'nullable|string|max:100',
            // 'country' => 'nullable|string|max:100',
            // 'dob' => 'nullable|date',
            // 'bio' => 'nullable|string|max:1000',
            // 'is_allowed' => 'required|string|in:allowed,blocked',
            // 'avatar_base64' => 'nullable|string',
        ]);

        try {
            $user = new User();

            $user->name = $request->name;
            $getUsername = $request->username;
            // Check if username exists
            while (User::where('username', $getUsername)->exists()) {
                    $getUsername =  Str::random(6);
            }
            $user->username = $getUsername;
            $user->password = bcrypt($request->password); // Hash the password!
            // Check if username exists
            if (User::where('email', $request->email)->exists()) {
                return response()->json([
                'message' => 'Email alredy exists!',
                'email' => $request->email
            ]);
            }else{
                $user->email = $request->email;
            }
            
            $user->occupation = $request->occupation;
            $user->gender = $request->gender;
            $user->phone_number = $request->phone_number;
            $user->address_line = $request->address_line;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->dob = $request->dob;
            $user->bio = $request->bio;
            if ($request->is_allowed == "blocked")
            {
                $user->is_allowed = 0;
            }
            else
            {
                $user->is_allowed = 1;
            }
            if ($request->role == "admin")
            {
                $user->role_id = 2;
            }
            else
            {
                $user->role_id = 1;
            }
            
            // Upload pf_image if present
            if ($request->avatar_base64) {
                $base64String = $request->avatar_base64;

                if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
                    $extension = $matches[1];
                    $base64String = substr($base64String, strpos($base64String, ',') + 1);
                    $base64String = str_replace(' ', '+', $base64String);
                    $imageData = base64_decode($base64String);

                    if ($imageData === false) {
                        return response()->json(['message' => 'Invalid base64 image data'], 400);
                    }

                    $filename = 'avatars/' . \Str::uuid() . '.' . $extension;
                    $stored = Storage::disk('minio')->put($filename, $imageData);

                    if (!$stored) {
                        return response()->json(['message' => 'Failed to upload to MinIO'], 500);
                    }

                    $avatarUrl = Storage::disk('minio')->url($filename);
                    $user->pf_image = $avatarUrl;
                } else {
                    return response()->json(['message' => 'Invalid image format'], 400);
                }
            }

            $user->save();

            return response()->json([
                'message' => 'User created successfully.',
                'user' => $user
            ], 200);

                } catch (\Throwable $e) {
                    return response()->json([
                        'message' => 'Failed to create user.',
                        'error' => $e->getMessage(), // remove this line in production
                    ], 500);
                }

            }





}

// postman
// {
//   "name": "John Doe",
//   "username": "johndoe",
//   "occupation": "Developer",
//   "is_allowed": true,
//   "gender": "male",
//   "avatar_base64": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD...etc"
// }