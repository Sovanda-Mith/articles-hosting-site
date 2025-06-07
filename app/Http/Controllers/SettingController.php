<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

use function GuzzleHttp\json_encode;

class SettingController extends Controller
{
    public function blockedUsers()
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return auth()->user()->blockedUsers()->get();
    }

    public function mutedUsers()
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return auth()->user()->mutedUsers()->get();
    }

    public function updateNotificationSettings(Request $request)
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();

        $validated = $request->validate([
          'notify_on_article' => 'boolean',
          'notify_on_follow' => 'boolean',
          'new_feature' => 'boolean',
        ]);

        $user->settings()->update($validated);

        return response()->json(['message' => 'Settings updated successfully']);
    }

    public function downloadUserData()
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();

        // Create a temp directory
        $tempPath = storage_path("app/temp_user_data_" . $user->id . '_' . now()->timestamp);
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        file_put_contents("$tempPath/user.json", json_encode($user, JSON_PRETTY_PRINT));

        // Create a zip file
        $zipFileName = "user_data_{$user->id}.zip";
        $zipPath = storage_path("app/{$zipFileName}");
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($tempPath));
            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        }

        // Clean up temp directory
        File::deleteDirectory($tempPath);

        // Return file as download response
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
