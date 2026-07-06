<x-admin.layout title="Kategori">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Kategori
        </h2>
    </x-slot>

    <div class="space-y-4">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-gray-500">Kelola kategori produk di toko Anda.</p>
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-md bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        @if ($categories->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-200 bg-white py-16 text-center">
                <p class="text-sm font-medium text-gray-900">Belum ada kategori</p>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kategori pertama Anda.</p>
                <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                    Tambah Kategori
                </a>
            </div>
        @endif

        @if ($categories->isNotEmpty())
            {{-- Tampilan kartu — dipakai di layar kecil (mobile) --}}
            <div class="grid grid-cols-1 gap-3 sm:hidden">
                @foreach ($categories as $category)
                    <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="truncate font-medium text-gray-900">{{ $category->name }}</p>
                                <p class="mt-0.5 truncate text-xs text-gray-500">{{ $category->description ?: '—' }}</p>
                            </div>
                            @if ($category->is_active)
                                <span class="shrink-0 inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Aktif</span>
                            @else
                                <span class="shrink-0 inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">Nonaktif</span>
                            @endif
                        </div>

                        <p class="mt-2 text-xs text-gray-400">{{ $category->products_count ?? 0 }} produk</p>

                        <div class="mt-3 flex items-center gap-2 border-t border-gray-100 pt-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="flex flex-1 items-center justify-center gap-1.5 rounded-md bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <x-admin.delete-button
                                :action="route('admin.categories.destroy', $category->id)"
                                title="Hapus Kategori?"
                                :confirm="'Hapus kategori \''.$category->name.'\'? Produk dalam kategori ini tidak akan ikut terhapus.'"
                                class="flex flex-1 items-center justify-center gap-1.5 rounded-md bg-red-50 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-100"
                                :label="'Hapus'"
                            />
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tampilan tabel — dipakai di layar sm ke atas --}}
            <div class="hidden overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm sm:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Deskripsi</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Jumlah Produk</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-50/60">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $category->name }}</td>
                                    <td class="max-w-xs truncate px-4 py-3 text-gray-500">{{ $category->description ?: '—' }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $category->products_count ?? 0 }}</td>
                                    <td class="px-4 py-3">
                                        @if ($category->is_active)
                                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Aktif</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="rounded-md p-2 text-gray-500 transition hover:bg-gray-100 hover:text-emerald-600" title="Edit">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <x-admin.delete-button
                                                :action="route('admin.categories.destroy', $category->id)"
                                                title="Hapus Kategori?"
                                                :confirm="'Hapus kategori \''.$category->name.'\'? Produk dalam kategori ini tidak akan ikut terhapus.'"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div>{{ $categories->links() }}</div>
    </div>
</x-admin.layout>
