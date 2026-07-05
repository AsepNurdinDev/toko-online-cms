@props(['title' => null])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title.' — ' : '' }}{{ setting('site_name', config('app.name')) }}</title>
    <meta name="description" content="{{ setting('site_description', '') }}">

    @if (setting('favicon'))
        <link rel="icon" href="{{ storageUrl(setting('favicon')) }}">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--
        SISTEM TEMA — satu-satunya tempat yang perlu diubah untuk mengganti
        warna aksen toko per klien. Admin bisa mengatur ini lewat halaman
        Pengaturan > Warna Tema (tanpa perlu sentuh kode).
        Semua komponen di components/shop/* memakai var(--shop-primary),
        bukan warna Tailwind yang di-hardcode, jadi konsisten di semua halaman.
    --}}
    @php
        $themePrimary = setting('theme_color', '#f59e0b');
    @endphp
    <style>
        :root {
            --shop-primary: {{ $themePrimary }};
            --shop-primary-dark: color-mix(in srgb, {{ $themePrimary }} 80%, black);
            --shop-primary-hover: color-mix(in srgb, {{ $themePrimary }} 88%, black);
            --shop-primary-soft: color-mix(in srgb, {{ $themePrimary }} 12%, white);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 font-sans text-gray-900 antialiased" x-data="{ mobileMenu: false }">

    <x-shop.topbar />
    <x-shop.navbar />

    <!-- Flash message -->
    @if (session('success'))
        <div class="mx-auto mt-4 max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Page content -->
    <main>
        {{ $slot }}
    </main>

    <x-shop.footer />
    <x-shop.whatsapp-button />
</body>
</html>
