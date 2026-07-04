<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Muat semua file helper di app/Helpers secara otomatis.
        // (File-file ini sebelumnya tidak pernah ter-load sehingga
        // fungsi seperti setting(), rupiah(), storageUrl() akan
        // menyebabkan "Call to undefined function" jika tidak di-require di sini.)
        foreach (glob(app_path('Helpers/*.php')) as $helperFile) {
            require_once $helperFile;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
