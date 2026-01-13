<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageService
{
    /**
     * Compress and store an image.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @param int $quality
     * @return string
     */
    public function compressAndStore(UploadedFile $file, string $directory, ?string $disk = null, int $quality = 70): string
    {
        $disk = $disk ?? config('filesystems.default');
        
        // Read the image
        $image = Image::read($file);

        // Resize the image if it's too large (optional, but good for "small size as i can")
        // Ensuring max width of 1200px while maintaining aspect ratio
        $image->scaleDown(width: 1200);

        // Encode the image to WebP
        $encoded = $image->toWebp($quality);

        // Generate a unique filename
        $filename = $file->hashName();
        // Change extension to webp
        $filename = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
        
        $path = $directory . '/' . $filename;

        // Store the image
        Storage::disk($disk)->put($path, (string) $encoded);
        
        return $path;
    }
}
