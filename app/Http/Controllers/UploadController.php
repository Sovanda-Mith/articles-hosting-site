<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadCover(Request $request)
    {
        $request->validate([
          'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('cover');
        $path = 'cover/' . uniqid() . '.' . $image->getClientOriginalExtension();

        $stored = Storage::disk('minio')->put($path, file_get_contents($image));

        if (!$stored) {
            return response()->json(['message' => 'Failed to upload image'], 500);
        }

        // Get the public URL
        $url = Storage::disk('minio')->url($path);

        return response()->json(['url' => $url]);
    }





}
