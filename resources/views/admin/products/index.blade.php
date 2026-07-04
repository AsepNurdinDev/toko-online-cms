<x-admin-layout title="Produk">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Produk
        </h2>
    </x-slot>

    <div class="space-y-4">

        <!-- Toolbar -->
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" class="flex w-full flex-col gap-3 sm:flex-row sm:max-w-lg">
                <div class="relative flex-1">
                    <svg class="pointer-events-none absolute left-3 top-2.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full rounded-md border-gray-300 pl-9 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>
                <select name="category" onchange="this.form.submit()"
                    class="rounded-md border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-md bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Produk</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Harga</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Stok</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($products ?? [] as $product)
                            <tr class="hover:bg-gray-50/60">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/64x64?text=%20' }}"
                                            alt="{{ $product->name }}" class="h-11 w-11 shrink-0 rounded-lg border border-gray-200 object-cover">
                                        <span class="font-medium text-gray-900">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $product->category->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-gray-900">Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @if(($product->stock ?? 0) > 0)
                                        <span class="text-gray-700">{{ $product->stock }}</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700">Habis</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($product->is_active ?? true)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="rounded-md p-2 text-gray-500 transition hover:bg-gray-100 hover:text-emerald-600" title="Edit">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus produk &quot;{{ $product->name }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
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
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <p class="text-sm font-medium text-gray-900">Belum ada produk</p>
                                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan produk pertama Anda.</p>
                                    <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                                        Tambah Produk
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($products) && $products instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div>{{ $products->links() }}</div>
        @endif
    </div>
</x-admin-layout>
