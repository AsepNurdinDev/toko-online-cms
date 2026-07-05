# Panduan Kustomisasi untuk Klien Berbeda

View ini sudah dipecah jadi komponen kecil supaya sekali bangun, bisa dipakai berkali-kali untuk
toko online klien yang berbeda-beda — tinggal ganti warna, logo, dan teks tanpa bongkar banyak file.

## 1. Ganti warna brand tanpa sentuh kode (paling sering dipakai)

Login sebagai admin → **Pengaturan** → bagian **Warna Tema Toko** → pilih salah satu preset atau
pakai color picker untuk warna kustom → Simpan.

Semua halaman toko (navbar, banner, kartu produk, footer, tombol "Lihat semua", dsb) otomatis
mengikuti warna ini karena semuanya memakai CSS variable `--shop-primary` yang di-generate dari
kolom `theme_color` di tabel settings. Tidak ada Tailwind class warna yang di-hardcode lagi di
halaman toko (kecuali tombol WhatsApp yang sengaja tetap hijau, karena itu identitas WhatsApp).

**Catatan untuk backend:** tambahkan `theme_color` ke `fillable`/validasi model `Setting` &
controller `SettingController` (format hex, contoh `#f59e0b`) supaya nilainya benar-benar tersimpan.

## 2. Struktur komponen toko (`resources/views/components/shop/`)

| File | Fungsi | Kapan diedit |
|---|---|---|
| `topbar.blade.php` | Bar info kecil di atas navbar (WA, deskripsi singkat) | Ganti/hapus kalau klien tidak butuh |
| `navbar.blade.php` | Navbar utama + search + menu mobile | Ganti struktur menu di sini |
| `hero-banner.blade.php` | Slider banner beranda | Ganti gaya hero di sini saja, berlaku ke semua halaman |
| `footer.blade.php` | Footer + kontak + sosial media | Ganti kolom footer di sini |
| `whatsapp-button.blade.php` | Tombol WA melayang | Ganti posisi/ikon di sini |

`components/shop-layout.blade.php` cuma "merakit" komponen di atas + menyuntikkan variable warna
tema. Untuk klien baru yang butuh layout sangat berbeda (misal tanpa topbar, atau navbar gelap),
paling gampang: duplikasi `shop-layout.blade.php` jadi `shop-layout-dark.blade.php`, pakai komponen
yang sama tapi susunan/varian berbeda, lalu di halaman klien tsb pakai `<x-shop-layout-dark>`.

## 3. Struktur komponen admin (`resources/views/components/admin/`)

- `admin-layout.blade.php` — sidebar + topbar dashboard admin (tidak ikut tema toko, sengaja beda
  supaya panel admin tetap konsisten dark/professional apa pun warna toko klien).
- `image-upload.blade.php` — komponen upload gambar dengan pratinjau + indikator jelas
  "Foto baru dipilih" dan tombol Batal. Dipakai di form profil, pengaturan (logo/favicon), banner,
  dan produk. Kalau butuh upload gambar di form baru, tinggal pakai:

  ```blade
  <x-admin.image-upload
      name="thumbnail"
      :current="$product->thumbnail ? storageUrl($product->thumbnail) : null"
      shape="square"   {{-- circle | square | banner --}}
      label="Pilih Gambar"
      hint="Format JPG/PNG, maks 2MB."
      :errors="$errors->get('thumbnail')"
  />
  ```

## 4. Alur kerja untuk klien baru (checklist singkat)

1. Copy project, jalankan migrasi & seeder seperti biasa.
2. Login admin → **Pengaturan**: isi nama toko, deskripsi, WhatsApp, logo, favicon, dan **warna tema**.
3. Upload banner di **Admin → Banner** (rasio gambar 21:7 supaya teks banner tidak menutupi gambar).
4. Kalau butuh tampilan yang benar-benar beda (bukan cuma warna), edit komponen di
   `components/shop/*` — perubahan langsung berlaku ke semua halaman toko yang pakai `<x-shop-layout>`.
5. Halaman admin (dashboard, produk, kategori, banner, pengaturan, profil) tidak perlu diubah per
   klien; itu sudah dirancang generik.
