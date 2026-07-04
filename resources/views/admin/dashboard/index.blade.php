<x-admin-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="space-y-6">

        <div>
            <h1 class="text-xl font-semibold text-gray-900">Halo, {{ Auth::user()->name ?? 'Admin' }} 👋</h1>
            <p class="mt-1 text-sm text-gray-500">Berikut ringkasan aktivitas toko Anda hari ini.</p>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Produk</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalProducts ?? 0 }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalCategories ?? 0 }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7.414 7.414a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0L4.293 12.293A1 1 0 014 11.586V6a3 3 0 013-3z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Banner</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalBanners ?? 0 }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16v12H4V6z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Admin</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalAdmins ?? 0 }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-violet-50 text-violet-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick actions -->
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-sm font-semibold text-gray-900">Aksi Cepat</h3>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">+</span>
                    <span class="text-sm font-medium text-gray-700">Tambah Produk</span>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 p-4 transition hover:border-amber-300 hover:bg-amber-50">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 text-amber-600">+</span>
                    <span class="text-sm font-medium text-gray-700">Tambah Kategori</span>
                </a>
                <a href="{{ route('admin.banners.create') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 p-4 transition hover:border-sky-300 hover:bg-sky-50">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-100 text-sky-600">+</span>
                    <span class="text-sm font-medium text-gray-700">Tambah Banner</span>
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
