<x-admin-layout title="Banner">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Banner
        </h2>
    </x-slot>

    <div class="space-y-4">

        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">Banner tampil sebagai slider di halaman utama toko.</p>
            <a href="{{ route('admin.banners.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-md bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Banner
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($banners as $banner)
                <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="relative aspect-[16/7] bg-gray-100">
                        <img src="{{ storageUrl($banner->image) }}"
                            alt="{{ $banner->title }}" class="h-full w-full object-cover">
                        <span class="absolute left-3 top-3 inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium
                            {{ $banner->is_active ? 'bg-emerald-500 text-white' : 'bg-gray-800/70 text-white' }}">
                            {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div class="p-4">
                        <p class="truncate font-medium text-gray-900">{{ $banner->title }}</p>
                        <p class="truncate text-xs text-gray-500">{{ $banner->subtitle ?: '—' }}</p>

                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xs text-gray-400">Urutan: {{ $banner->sort_order }}</span>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                    class="rounded-md p-2 text-gray-500 transition hover:bg-gray-100 hover:text-emerald-600" title="Edit">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus banner &quot;{{ $banner->title }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-600" title="Hapus">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-xl border border-dashed border-gray-200 bg-white py-16 text-center">
                    <p class="text-sm font-medium text-gray-900">Belum ada banner</p>
                    <p class="mt-1 text-sm text-gray-500">Tambahkan banner untuk mempercantik halaman utama toko.</p>
                    <a href="{{ route('admin.banners.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                        Tambah Banner
                    </a>
                </div>
            @endforelse
        </div>

        <div>{{ $banners->links() }}</div>
    </div>
</x-admin-layout>
