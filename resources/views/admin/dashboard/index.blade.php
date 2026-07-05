<x-admin-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="space-y-6">

        <!-- Welcome banner -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 p-6 shadow-sm sm:p-8">
            <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full bg-emerald-500/10 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-16 right-24 h-56 w-56 rounded-full bg-sky-500/10 blur-2xl"></div>

            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-emerald-300">{{ now()->translatedFormat('l, d F Y') }}</p>
                    <h1 class="mt-1 text-2xl font-bold text-white">Halo, {{ Auth::user()->name ?? 'Admin' }} 👋</h1>
                    <p class="mt-1 text-sm text-slate-300">Berikut ringkasan aktivitas toko Anda hari ini.</p>
                </div>
                <a href="{{ route('shop.home') }}" target="_blank"
                    class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-medium text-white ring-1 ring-white/20 backdrop-blur transition hover:bg-white/20">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Lihat Toko
                </a>
            </div>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <span class="absolute inset-y-0 left-0 w-1 bg-emerald-500"></span>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Produk</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalProducts ?? 0 }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.products.index') }}" class="mt-3 inline-block text-xs font-medium text-emerald-600 hover:underline">Kelola produk &rarr;</a>
            </div>

            <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <span class="absolute inset-y-0 left-0 w-1 bg-amber-500"></span>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalCategories ?? 0 }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7.414 7.414a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0L4.293 12.293A1 1 0 014 11.586V6a3 3 0 013-3z" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="mt-3 inline-block text-xs font-medium text-amber-600 hover:underline">Kelola kategori &rarr;</a>
            </div>

            <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <span class="absolute inset-y-0 left-0 w-1 bg-sky-500"></span>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Banner</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalBanners ?? 0 }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-600 transition group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16v12H4V6z" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.banners.index') }}" class="mt-3 inline-block text-xs font-medium text-sky-600 hover:underline">Kelola banner &rarr;</a>
            </div>

            <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <span class="absolute inset-y-0 left-0 w-1 bg-violet-500"></span>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Admin</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalAdmins ?? 0 }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600 transition group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="mt-3 inline-block text-xs font-medium text-violet-600 hover:underline">Profil saya &rarr;</a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Quick actions -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm lg:col-span-2">
                <h3 class="mb-4 text-sm font-semibold text-gray-900">Aksi Cepat</h3>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-lg font-bold text-emerald-600">+</span>
                        <span class="text-sm font-medium text-gray-700">Tambah Produk</span>
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 p-4 transition hover:border-amber-300 hover:bg-amber-50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-lg font-bold text-amber-600">+</span>
                        <span class="text-sm font-medium text-gray-700">Tambah Kategori</span>
                    </a>
                    <a href="{{ route('admin.banners.create') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 p-4 transition hover:border-sky-300 hover:bg-sky-50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-sky-100 text-lg font-bold text-sky-600">+</span>
                        <span class="text-sm font-medium text-gray-700">Tambah Banner</span>
                    </a>
                </div>
            </div>

            <!-- Tips -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                <h3 class="mb-3 text-sm font-semibold text-gray-900">Tips</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">✓</span>
                        Atur warna tema toko di <a href="{{ route('admin.settings.edit') }}" class="font-medium text-emerald-600 hover:underline">Pengaturan</a> agar tampilan sesuai brand Anda.
                    </li>
                    <li class="flex gap-2">
                        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">✓</span>
                        Gunakan gambar banner rasio 21:7 agar judul &amp; tombol tidak terpotong.
                    </li>
                    <li class="flex gap-2">
                        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">✓</span>
                        Nonaktifkan produk yang stoknya habis lewat toggle "Tampilkan" di halaman produk.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-admin-layout>
