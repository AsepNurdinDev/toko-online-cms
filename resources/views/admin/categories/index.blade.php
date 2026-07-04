<x-admin-layout title="Kategori">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Kategori
        </h2>
    </x-slot>

    <div class="space-y-4">

        <!-- Toolbar -->
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" class="w-full sm:max-w-xs">
                <div class="relative">
                    <svg class="pointer-events-none absolute left-3 top-2.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                        class="w-full rounded-md border-gray-300 pl-9 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>
            </form>

            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-md bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Gambar</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jumlah Produk</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($categories ?? [] as $category)
                            <tr class="hover:bg-gray-50/60">
                                <td class="px-4 py-3">
                                    <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://placehold.co/64x64?text=%20' }}"
                                        alt="{{ $category->name }}" class="h-11 w-11 rounded-lg border border-gray-200 object-cover">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $category->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $category->products_count ?? $category->products->count() ?? 0 }}</td>
                                <td class="px-4 py-3">
                                    @if($category->is_active ?? true)
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
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus kategori &quot;{{ $category->name }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-600" title="Hapus">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center">
                                    <p class="text-sm font-medium text-gray-900">Belum ada kategori</p>
                                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kategori pertama Anda.</p>
                                    <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                                        Tambah Kategori
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($categories) && $categories instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div>{{ $categories->links() }}</div>
        @endif
    </div>
</x-admin-layout>
