<?php

if (! function_exists('storageUrl')) {

    function storageUrl(
        ?string $path,
        string $default = 'images/no-image.png'
    ): string {

        if (blank($path)) {
            return asset($default);
        }

        return asset('storage/' . ltrim($path, '/'));

    }

}

if (! function_exists('imageExists')) {

    function imageExists(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        return file_exists(
            public_path('storage/' . $path)
        );
    }

}