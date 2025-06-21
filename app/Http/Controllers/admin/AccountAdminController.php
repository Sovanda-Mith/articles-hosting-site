<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AccountAdminController extends Controller
{

    public function profile(Request $request)
    {
         return $request->user(); 
    }

    public function update(Request $request)
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
            $user = User::findOrFail($request->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->occupation = $request->occupation;
            $user->gender = $request->gender;
            $user->phone_number = $request->phone_number;
            $user->address_line = $request->address_line;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->dob = $request->dob;
            

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
}

