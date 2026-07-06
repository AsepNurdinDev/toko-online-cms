# Panduan Instalasi & Catatan Update

Timpa/merge isi zip ini ke `resources/views/` di project Laravel Anda seperti biasa.

## ⚠️ WAJIB DISESUAIKAN — 1 perubahan yang bisa bikin error kalau kelewatan

Halaman login admin dipindah dari `resources/views/auth/login.blade.php` ke
`resources/views/admin/auth/login.blade.php` (supaya semua halaman admin ada di satu folder,
tidak tercampur sisa folder `auth/` bawaan Breeze).

**Cari di controller Anda** baris yang memanggil `view('auth.login')` (biasanya di
`AdminAuthController` atau sejenisnya), lalu ganti jadi:
```php
return view('admin.auth.login');
```
Kalau tidak diganti, halaman login akan error "View [auth.login] not found".

Tidak ada perubahan lain yang butuh sentuhan controller/route — semua rename komponen di bawah
ini murni di sisi view (Blade), controller tidak perlu diubah.

---

## Ringkasan besar update kali ini

### 1. Struktur folder dirombak total (lihat `CUSTOMIZATION.md` untuk peta lengkap)
- `components/` sekarang cuma isinya 2 folder: `components/admin/` dan `components/shop/`.
  Semua sisa scaffolding Laravel Breeze yang tidak dipakai (`secondary-button`, `danger-button`,
  `modal`, `nav-link`, `responsive-nav-link`, `application-logo`, `layouts/navigation.blade.php`,
  `layouts/app.blade.php`, serta halaman `register`/`forgot-password`/`reset-password`/
  `confirm-password`/`verify-email`) **sudah dihapus** karena tidak pernah dipakai sistem ini
  (hanya ada 1 login admin, tidak ada akun pelanggan).
- Nama tag komponen berubah mengikuti folder barunya, misalnya:
  `<x-admin-layout>` → `<x-admin.layout>`, `<x-shop-layout>` → `<x-shop.layout>`,
  `<x-input-label>` → `<x-admin.input-label>`, `<x-product-card>` → `<x-shop.product-card>`, dst.
  Semua pemakaian di dalam folder `views/` yang saya kirim ini **sudah otomatis disesuaikan** —
  jadi kalau Anda cuma pakai file-file dari zip ini, tidak perlu ubah apa-apa lagi.
- Ditambahkan `shop/about.blade.php` sebagai **contoh/template** kalau nanti klien minta halaman
  statis baru (Tentang Kami, Kontak, dll) — tinggal copy pola itu.

### 2. Admin sekarang lebih nyaman dipakai
- **Sidebar tidak lagi ikut ter-scroll** — sekarang "nempel" (sticky) di layar saat konten
  panjang di-scroll, baik di desktop maupun tablet.
- **Perbaikan mobile:** overlay menu mobile otomatis menutup saat sebuah menu diklik, dan ada
  penanganan supaya overlay tidak "nyangkut" terbuka saat kembali lewat tombol back browser
  (yang sebelumnya bisa membuat seluruh halaman terasa tidak bisa diklik/di-tap).
- **Tabel Produk & Kategori kini responsif sungguhan:** di layar HP, daftar tampil sebagai kartu
  bertumpuk (tombol Edit/Hapus langsung terlihat, tidak perlu geser tabel ke kanan). Di layar
  besar, tetap tampil sebagai tabel seperti biasa.
- **Dialog konfirmasi kustom:** semua `confirm()` bawaan browser (hapus produk, kategori, banner,
  foto galeri) diganti dialog kustom yang konsisten di seluruh admin — lihat
  `components/admin/confirm-dialog.blade.php` dan `components/admin/delete-button.blade.php`.
  Alert bawaan browser di komponen upload foto juga sudah diganti pesan error inline.
- **Bagian "Warna Tema Toko" di halaman Pengaturan sudah dihapus** (sesuai permintaan — dianggap
  tidak penting untuk dikontrol admin). Warna tema toko sekarang jadi 1 baris konstanta di kode:
  `components/shop/layout.blade.php` (variabel `$themePrimary`) — developer yang ganti langsung
  di situ tiap kali ada klien baru. **Kalau sebelumnya sempat menambahkan kolom `theme_color` di
  tabel `settings`, kolom itu sekarang tidak dipakai lagi** (boleh dibiarkan/boleh dihapus, bebas).
- **Tips di dashboard dihapus** (termasuk tips soal warna tema) sesuai permintaan — dashboard
  sekarang cuma header sambutan, kartu statistik, dan Aksi Cepat.

### 3. Banner: judul sekarang opsional
- Field **Judul Banner** di form tambah/edit banner tidak lagi wajib diisi (`required` dihapus).
- Tampilan hero di beranda (`components/shop/hero-banner.blade.php`) menyesuaikan: kalau banner
  tidak punya judul/subjudul/tombol sama sekali, panel teks & gradasi gelap otomatis tidak
  ditampilkan (banner tampil polos gambar saja, tidak ada elemen teks kosong yang mengambang).
  Kalau salah satu diisi, hanya elemen yang diisi yang muncul.

**Wajib disesuaikan di backend:** ubah validasi `title` di `StoreBannerRequest`/
`UpdateBannerRequest` (atau di mana pun validasinya) dari `required` menjadi `nullable`, supaya
form submit tanpa judul tidak ditolak validasi.

### 4. Galeri foto produk (dari update sebelumnya, masih berlaku)
Kalau belum diterapkan di backend, `product_images` table + relasi + controller logic masih
perlu ditambahkan — lihat riwayat chat sebelumnya untuk kode lengkapnya (migrasi, model
`ProductImage`, method `attachImages`/`removeImage` di `ProductService`, serta method
`destroyImage` + route di `ProductController`).

---

## Asumsi penting (karena controller/model tidak ikut di-upload)

**Route yang dipakai di layout & halaman (pastikan ada di `routes/web.php`):**
```
admin.dashboard
admin.profile.edit
admin.logout
admin.categories.index / .create / .store / .edit / .update / .destroy
admin.products.index / .create / .store / .edit / .update / .destroy
admin.products.images.destroy
admin.banners.index / .create / .store / .edit / .update / .destroy
admin.settings.edit / .update
shop.home / shop.products / shop.show
```

**Variabel yang diharapkan dikirim controller ke view:**
- `admin/product/index` → `$products` (paginate)
- `admin/category/index` → `$categories` (paginate)
- `admin/banner/index` → `$banners` (paginate)
- `admin/product/create` & `edit` → `$categories`, dan `$product` untuk edit (relasi `images`
  sebaiknya di-eager-load: `$product->load('images')`)
- `admin/dashboard/index` → opsional `$totalProducts`, `$totalCategories`, `$totalBanners`,
  `$totalAdmins` (kalau tidak dikirim, otomatis tampil 0, tidak error)
- `admin/settings/edit` → `$settings` (array/collection key-value)

File gambar diasumsikan disimpan via `Storage::disk('public')` dan diakses lewat helper
`storageUrl()` — pastikan sudah menjalankan `php artisan storage:link`.

Semua bagian sudah pakai `old()` dan `?? ''`/`?? default` sehingga kalaupun ada field yang beda
nama, halaman tetap bisa dibuka (tidak fatal error), tinggal disesuaikan nama field pada input
`name="..."` dan variabel di blade.
