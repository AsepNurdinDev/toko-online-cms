# Panduan Instalasi Tampilan Admin

Zip ini berisi seluruh folder `views/` (letakkan isinya ke `resources/views/` di project Laravel Anda, timpa/merge dengan yang sudah ada).

## Yang ditambahkan/diubah
- **Baru:** `components/admin-layout.blade.php` — layout admin dengan sidebar (dark, collapsible di mobile via Alpine.js) + topbar + flash message otomatis (`session('success')` / `session('error')`).
- **Baru:** `components/admin-nav-link.blade.php` — komponen item menu sidebar dengan status aktif otomatis (pakai `request()->routeIs()`).
- **Diisi (sebelumnya kosong):** semua file di `admin/categories/`, `admin/products/`, `admin/banners/`, `admin/settings/edit.blade.php`.
- **Diupdate:** `admin/dashboard/index.blade.php` dan `admin/profile/edit.blade.php` sekarang memakai `<x-admin-layout>`.

Layout lama (`layouts/app.blade.php`, `layouts/navigation.blade.php`) **tidak diubah**, jadi kalau ada halaman non-admin yang masih memakai `<x-app-layout>`, tidak akan terpengaruh.

## Asumsi penting (karena controller/model tidak ikut di-upload)
Karena saya hanya menerima folder `views`, saya menyesuaikan field & nama route berdasarkan konvensi Laravel resource controller standar. Sesuaikan controller/route Anda (atau beri tahu saya nama sebenarnya) supaya tidak error `Route not defined` / `Undefined property`:

**Route yang dipakai di layout & halaman (pastikan ada di `routes/web.php`):**
```
admin.dashboard
admin.profile.edit
admin.logout
admin.categories.index / .create / .store / .edit / .update / .destroy
admin.products.index / .create / .store / .edit / .update / .destroy
admin.banners.index / .create / .store / .edit / .update / .destroy
admin.settings.edit / .update
```

**Field yang diasumsikan ada di masing-masing model:**
- `Category`: `name`, `description`, `image`, `is_active`
- `Product`: `name`, `category_id`, `description`, `price`, `stock`, `image`, `is_active` (relasi `category()` ke `Category`)
- `Banner`: `title`, `image`, `link`, `order`, `is_active`
- `Setting` (singleton): `site_name`, `tagline`, `site_email`, `site_phone`, `site_address`, `logo`, `facebook_url`, `instagram_url`, `whatsapp_url`

**Variabel yang diharapkan dikirim controller ke view:**
- `categories/index` → `$categories` (boleh paginate atau collection biasa)
- `products/index` → `$products`, `$categories` (untuk filter dropdown)
- `products/create` & `products/edit` → `$categories`
- `banners/index` → `$banners`
- `dashboard/index` → opsional `$totalProducts`, `$totalCategories`, `$totalBanners`, `$totalUsers` (kalau tidak dikirim, otomatis tampil 0, tidak error)
- `settings/edit` → `$setting`

File gambar diasumsikan disimpan via `Storage::disk('public')` sehingga ditampilkan dengan `asset('storage/...')` — pastikan sudah menjalankan `php artisan storage:link`.

Semua bagian sudah pakai `old()` dan `?? ''`/`?? default` sehingga kalaupun ada field yang beda nama, halaman tetap bisa dibuka (tidak fatal error), tinggal disesuaikan nama field pada input `name="..."` dan variabel di blade.
