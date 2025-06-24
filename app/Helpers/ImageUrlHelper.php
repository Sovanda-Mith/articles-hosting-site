<?php

namespace App\Helpers;

class ImageUrlHelper
{
    /**
     * Convert MinIO URLs to use Laravel proxy route
     */
    public static function convertMinioUrl($url)
    {
        if (empty($url)) {
            return $url;
        }

        // If it's already a proxy URL, return as is
        if (strpos($url, '/storage/minio/') !== false) {
            return $url;
        }

        // Convert old MinIO URLs to proxy URLs (production)
        if (strpos($url, 's3.bloggist.fun') !== false) {
            // Extract the path from the URL
            $pattern = '/https?:\/\/s3\.bloggist\.fun\/(.+)/';
            if (preg_match($pattern, $url, $matches)) {
                $path = $matches[1];
                return self::generateProxyUrl($path);
            }
        }

        // Convert localhost MinIO URLs to proxy URLs (development)
        if (strpos($url, 'localhost:9000') !== false) {
            $pattern = '/https?:\/\/localhost:9000\/(.+)/';
            if (preg_match($pattern, $url, $matches)) {
                $path = $matches[1];
                return self::generateProxyUrl($path);
            }
        }

        // For simple filenames, check if they exist in MinIO
        if (!str_contains($url, 'http') && !str_contains($url, '/')) {
            // This is likely a simple filename, convert to proxy URL
            return self::generateProxyUrl('cover/' . $url);
        }

        return $url;
    }

    /**
     * Generate proxy URL based on environment
     */
    private static function generateProxyUrl($path)
    {
        // Use secure_url for production, url for development
        if (app()->environment('production')) {
            return secure_url('/storage/minio/' . $path);
        } else {
            return url('/storage/minio/' . $path);
        }
    }

    /**
     * Get image URL for articles
     */
    public static function getArticleImageUrl($imageField)
    {
        return self::convertMinioUrl($imageField);
    }
}
