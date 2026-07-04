<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 1. Jika user BELUM login dan mencoba akses halaman terproteksi, lempar ke /admin/login
        $middleware->redirectGuestsTo(fn () => route('admin.login'));

        // 2. Jika user SUDAH login tapi iseng buka halaman /admin/login lagi,
        //    lempar mereka langsung ke admin dashboard.
        $middleware->redirectUsersTo(fn () => route('admin.dashboard')); // <-- Diubah ke admin.dashboard
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();