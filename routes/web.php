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
Route::view('/profile', 'shop.profile')->name('shop.profile');
Route::view('/layanan', 'shop.layanan')->name('shop.layanan');
Route::view('/kontak', 'shop.kontak')->name('shop.kontak');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
