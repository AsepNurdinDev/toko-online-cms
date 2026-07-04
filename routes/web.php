<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// ==========================================
// HALAMAN TOKO (PUBLIK, TANPA LOGIN)
// Pemesanan sepenuhnya lewat WhatsApp, tidak ada cart/akun customer.
// ==========================================
Route::get('/', [ShopController::class, 'home'])->name('shop.home');
Route::get('/produk', [ShopController::class, 'products'])->name('shop.products');
Route::get('/produk/{slug}', [ShopController::class, 'show'])->name('shop.show');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
