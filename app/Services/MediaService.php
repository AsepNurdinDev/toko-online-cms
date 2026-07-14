<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaService
{
    public function upload(
        UploadedFile $file,
        string $directory = 'uploads'
    ): string {
        $filename = Str::uuid().'.jpg';
        $path = $directory.'/'.$filename;

        $image = Image::decode($file);
        $image->scale(width: 1200);

        Storage::disk('public')->put(
            $path,
            $image->encodeByExtension('jpg', quality: 75)
        );

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}