<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('activeMenu')) {

    function activeMenu(string|array $routes): bool
    {
        foreach ((array) $routes as $route) {

            if (Route::is($route)) {
                return true;
            }

        }

        return false;
    }

}

if (! function_exists('activeClass')) {

    function activeClass(
        string|array $routes,
        string $class = 'active'
    ): string {

        return activeMenu($routes)
            ? $class
            : '';

    }

}