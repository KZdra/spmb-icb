<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Convert an uploaded image to WebP and save to storage/app/public/{folder}
     * Digunakan KHUSUS untuk asset admin (Logo, Favicon, Cover Artikel)
     */
    public static function uploadAsWebp(UploadedFile $file, string $folder = 'uploads', int $quality = 82): string
    {
        $extension = strtolower($file->getClientOriginalExtension());

        // Jika file SVG atau ICO, simpan apa adanya
        if (in_array($extension, ['svg', 'ico'])) {
            return $file->store($folder, 'public');
        }

        // Cek dukungan GD imagewebp
        if (!extension_loaded('gd') || !function_exists('imagewebp')) {
            return $file->store($folder, 'public');
        }

        try {
            $imagePath = $file->getRealPath();
            $image = null;

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = @imagecreatefromjpeg($imagePath);
                    break;
                case 'png':
                    $image = @imagecreatefrompng($imagePath);
                    if ($image) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                    break;
                case 'gif':
                    $image = @imagecreatefromgif($imagePath);
                    if ($image) {
                        imagepalettetotruecolor($image);
                    }
                    break;
                case 'webp':
                    $image = @imagecreatefromwebp($imagePath);
                    break;
                default:
                    return $file->store($folder, 'public');
            }

            if (!$image) {
                return $file->store($folder, 'public');
            }

            $fileName = time() . '_' . Str::random(8) . '.webp';
            $relativeDir = trim($folder, '/');
            $fullDir = storage_path('app/public/' . $relativeDir);

            if (!file_exists($fullDir)) {
                mkdir($fullDir, 0755, true);
            }

            $targetFullPath = $fullDir . '/' . $fileName;
            imagewebp($image, $targetFullPath, $quality);
            imagedestroy($image);

            return $relativeDir . '/' . $fileName;

        } catch (\Throwable $e) {
            // Fallback aman jika konversi error
            return $file->store($folder, 'public');
        }
    }
}

