# Panduan Struktur & Kustomisasi

Struktur view sekarang dipisah tegas jadi 2 dunia: **admin** dan **shop (toko)**. Komponen
Breeze bawaan yang tidak terpakai sudah dibuang, dan semua tag komponen mengikuti pola yang
sama supaya gampang ditebak di mana harus mengedit.

## Peta folder

```
resources/views/
├── components/
│   ├── admin/          <- SEMUA komponen khusus admin, tidak ada yang tercampur
│   │   ├── layout.blade.php          → <x-admin.layout>            (sidebar + topbar admin)
│   │   ├── auth-layout.blade.php     → <x-admin.auth-layout>       (bungkus halaman login admin)
│   │   ├── nav-link.blade.php        → <x-admin.nav-link>          (item menu sidebar)
│   │   ├── dropdown.blade.php        → <x-admin.dropdown>          (dropdown profil di topbar)
│   │   ├── dropdown-link.blade.php   → <x-admin.dropdown-link>
│   │   ├── input-label.blade.php     → <x-admin.input-label>
│   │   ├── input-error.blade.php     → <x-admin.input-error>
│   │   ├── text-input.blade.php      → <x-admin.text-input>
│   │   ├── primary-button.blade.php  → <x-admin.primary-button>
│   │   ├── auth-session-status.blade.php → <x-admin.auth-session-status>
│   │   ├── image-upload.blade.php    → <x-admin.image-upload>      (upload 1 foto + pratinjau jelas)
│   │   ├── gallery-upload.blade.php  → <x-admin.gallery-upload>    (upload banyak foto sekaligus)
│   │   ├── confirm-dialog.blade.php  → <x-admin.confirm-dialog>    (dialog konfirmasi kustom, 1x di layout)
│   │   └── delete-button.blade.php   → <x-admin.delete-button>     (tombol hapus siap pakai)
│   └── shop/            <- SEMUA komponen khusus halaman toko
│       ├── layout.blade.php          → <x-shop.layout>             (bungkus semua halaman toko)
│       ├── topbar.blade.php          → <x-shop.topbar>             (bar info kecil di atas navbar)
│       ├── navbar.blade.php          → <x-shop.navbar>
│       ├── hero-banner.blade.php     → <x-shop.hero-banner>        (slider banner beranda)
│       ├── footer.blade.php          → <x-shop.footer>
│       ├── whatsapp-button.blade.php → <x-shop.whatsapp-button>    (tombol WA melayang)
│       └── product-card.blade.php    → <x-shop.product-card>       (kartu produk di grid)
│
├── admin/                <- Halaman-halaman admin (tidak berubah banyak, sudah rapi)
│   ├── auth/login.blade.php
│   ├── dashboard/index.blade.php
│   ├── category/{index,create,edit}.blade.php
│   ├── product/{index,create,edit}.blade.php
│   ├── banner/{index,create,edit}.blade.php
│   ├── settings/edit.blade.php
│   └── profile/{edit.blade.php, partials/...}
│
└── shop/                 <- Halaman-halaman toko yang tampil ke pembeli
    ├── home.blade.php
    ├── products.blade.php
    ├── show.blade.php
    └── about.blade.php    <- CONTOH/TEMPLATE halaman statis baru, lihat di bawah
```

Folder `layouts/` dan `auth/` bawaan Laravel Breeze (register, forgot-password, reset-password,
confirm-password, verify-email, navigation) **sudah dihapus** karena tidak dipakai sama sekali di
sistem ini (hanya ada 1 login admin, tidak ada registrasi pelanggan). Kalau nanti butuh salah satu
fitur itu kembali, tinggal generate ulang dari `php artisan breeze:install` di project terpisah lalu
salin yang dibutuhkan.

## Aturan sederhana: "saya mau ubah X, editnya di mana?"

| Saya mau ubah... | Edit file ini |
|---|---|
| Menu/logo/warna sidebar admin | `components/admin/layout.blade.php` |
| Tampilan navbar toko | `components/shop/navbar.blade.php` |
| Tampilan banner/hero beranda | `components/shop/hero-banner.blade.php` |
| Footer toko | `components/shop/footer.blade.php` |
| Kartu produk di grid | `components/shop/product-card.blade.php` |
| Warna brand/tema toko | 1 baris `$themePrimary` di `components/shop/layout.blade.php` |
| Halaman list/tambah/edit tertentu (produk, kategori, dst) | `admin/{nama-halaman}/*.blade.php` |
| Dialog konfirmasi hapus | `components/admin/confirm-dialog.blade.php` (tampilan) atau pakai `<x-admin.delete-button>` (pemakaian) |

## Menambah halaman baru untuk klien (misal "Tentang Kami", "Blog", dll)

Ikuti pola `shop/about.blade.php` yang sudah dibuatkan sebagai contoh:

1. Copy `shop/about.blade.php` → beri nama sesuai kebutuhan, misal `shop/kontak.blade.php`.
2. Ganti isinya, tetap dibungkus `<x-shop.layout title="...">...</x-shop.layout>` supaya otomatis
   dapat navbar, footer, tombol WhatsApp, dan warna tema yang sama seperti halaman lain.
3. Tambah route di `routes/web.php`:
   ```php
   Route::get('/kontak', fn () => view('shop.kontak'))->name('shop.kontak');
   ```
4. Kalau perlu tampil di menu, tambahkan link-nya di `components/shop/navbar.blade.php`.

Untuk halaman admin baru (misal mengelola "Testimoni"), ikuti pola folder yang sama:
buat `admin/testimoni/{index,create,edit}.blade.php`, semuanya tinggal dibungkus
`<x-admin.layout title="...">...</x-admin.layout>`.

## Dialog konfirmasi kustom (pengganti confirm() bawaan browser)

`components/admin/confirm-dialog.blade.php` sudah otomatis dimuat sekali di
`components/admin/layout.blade.php`, jadi tersedia di semua halaman admin. Untuk tombol hapus,
tinggal pakai:

```blade
<x-admin.delete-button
    :action="route('admin.products.destroy', $product->id)"
    title="Hapus Produk?"
    :confirm="'Hapus produk \''.$product->name.'\'? Tindakan ini tidak bisa dibatalkan.'"
/>
```

Tidak perlu tulis `<form>` atau `onsubmit="confirm(...)"` manual lagi — komponen ini sudah
membungkus form + tombol + pemicu dialog sekaligus.

## Upload foto (1 foto & banyak foto)

- **1 foto** (logo, thumbnail produk, foto profil, banner): `<x-admin.image-upload>`
- **Banyak foto sekaligus** (galeri produk): `<x-admin.gallery-upload>`

Keduanya sudah menampilkan status jelas ("Foto baru dipilih: nama-file.jpg") supaya admin tidak
bingung apakah fotonya sudah terpilih untuk diupload atau belum.
