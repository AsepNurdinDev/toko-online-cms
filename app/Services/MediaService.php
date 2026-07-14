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

        $image = Image::read($file);
        $image->scaleDown(width: 1200); 
        $image->save(Storage::disk('public')->path($path), quality: 75);

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}