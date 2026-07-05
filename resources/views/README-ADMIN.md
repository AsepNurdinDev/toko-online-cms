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

## Update terbaru (lihat juga `CUSTOMIZATION.md`)

- **Modular:** halaman toko (`shop-layout.blade.php`) sekarang dirakit dari komponen kecil di
  `components/shop/` (navbar, hero-banner, footer, whatsapp-button, topbar) supaya mudah dikustom
  ulang per klien. File `components/navbar.blade.php` (versi lama, khusus satu klien tertentu dan
  tidak lagi dipakai) sudah dihapus karena membingungkan dan tidak terhubung ke route manapun.
- **Warna tema:** ditambahkan bagian "Warna Tema Toko" di `admin/settings/edit.blade.php` yang
  menyimpan kolom baru **`theme_color`** (hex, contoh `#f59e0b`). Tambahkan kolom ini ke
  `fillable`/validasi model & controller `Setting` supaya tersimpan. Semua warna aksen di halaman
  toko sekarang mengikuti kolom ini via CSS variable, bukan warna Tailwind yang di-hardcode.
- **Upload foto lebih jelas:** komponen baru `components/admin/image-upload.blade.php` dipakai di
  form profil, logo/favicon pengaturan, banner, dan produk. Setelah memilih file, admin langsung
  melihat pratinjau + badge centang hijau + teks "Foto baru dipilih: nama-file.jpg" dan tombol
  Batal, supaya tidak ambigu apakah foto sudah dipilih/perlu disimpan atau belum. Juga memperbaiki
  bug di `admin/product/edit.blade.php` yang sebelumnya selalu menampilkan placeholder "Belum Ada
  Gambar" walau produk sudah punya foto.
- **Banner tidak lagi bertabrakan dengan teks:** `components/shop/hero-banner.blade.php` menambah
  gradasi gelap dari kiri & bawah sekaligus panel `bg-black/25 backdrop-blur` di belakang judul saat
  di layar kecil, plus `line-clamp` pada judul/subjudul, sehingga teks tetap terbaca di atas gambar
  banner apa pun.
- **Dashboard admin** dipercantik dengan header gradient sambutan, kartu statistik dengan aksen
  warna kiri, dan bagian tips — bukan sekadar kartu putih polos.
- **Galeri foto produk (banyak foto per produk):** ditambahkan komponen
  `components/admin/gallery-upload.blade.php` (multi-upload dengan pratinjau + hapus sebelum
  submit) dan dipakai di `admin/product/create.blade.php` & `edit.blade.php`. Foto lama pada
  halaman edit ditampilkan sebagai grid dengan tombol hapus per foto (pakai atribut HTML
  `form="delete-img-{id}"` supaya tidak perlu nested `<form>`). Di `shop/show.blade.php`, foto
  utama sekarang jadi galeri (foto besar + strip thumbnail, klik untuk ganti) yang otomatis
  menyesuaikan kalau produk belum punya foto tambahan (hanya tampil 1 foto seperti sebelumnya).

  **Wajib ditambahkan di backend supaya fitur ini berfungsi (belum ada di views-only ini):**
  1. Migrasi tabel `product_images` (`product_id`, `image`, `sort_order`).
  2. Relasi `Product::images()` (hasMany, urut berdasarkan `sort_order`).
  3. Di `ProductController@store`/`update`: loop `$request->file('gallery')` dan simpan tiap file
     ke `product_images` (field input bernama `gallery[]`, sudah dikirim otomatis oleh komponen).
  4. Route + method `destroyImage` untuk `admin.products.images.destroy` (hapus 1 foto galeri).

Semua bagian sudah pakai `old()` dan `?? ''`/`?? default` sehingga kalaupun ada field yang beda nama, halaman tetap bisa dibuka (tidak fatal error), tinggal disesuaikan nama field pada input `name="..."` dan variabel di blade.
