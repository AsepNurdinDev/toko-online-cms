<x-admin.layout title="Produk">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Produk
        </h2>
    </x-slot>

    <div class="space-y-4">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-gray-500">Kelola daftar produk yang dijual di toko Anda.</p>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-md bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>

        @if ($products->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-200 bg-white py-16 text-center">
                <p class="text-sm font-medium text-gray-900">Belum ada produk</p>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan produk pertama Anda.</p>
                <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                    Tambah Produk
                </a>
            </div>
        @endif

        @if ($products->isNotEmpty())
            {{-- Tampilan kartu — dipakai di layar kecil (mobile), tanpa perlu scroll horizontal --}}
            <div class="grid grid-cols-1 gap-3 sm:hidden">
                @foreach ($products as $product)
                    <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                        <div class="flex items-start gap-3">
                            <img src="{{ storageUrl($product->thumbnail, 'images/no-image.png') }}"
                                alt="{{ $product->name }}" class="h-14 w-14 shrink-0 rounded-lg border border-gray-200 object-cover">
                            <div class="min-w-0 flex-1">
                                <p class="truncate font-medium text-gray-900">{{ $product->name }}</p>
                                <p class="truncate text-xs text-gray-400">{{ $product->sku }} · {{ $product->category->name ?? '—' }}</p>
                                <p class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ rupiah($product->price) }}
                                    @if ($product->discount_price)
                                        <span class="ml-1 text-xs font-normal text-emerald-600">({{ rupiah($product->discount_price) }})</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            @if ($product->is_featured)
                                <span class="rounded-full bg-amber-50 px-2 py-0.5 text-[11px] font-semibold text-amber-600">Unggulan</span>
                            @endif
                            @if ($product->is_active)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Aktif</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">Nonaktif</span>
                            @endif
                            @if ($product->stock > 0)
                                <span class="text-xs text-gray-500">Stok: {{ $product->stock }}</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700">Stok Habis</span>
                            @endif
                        </div>

                        <div class="mt-3 flex items-center gap-2 border-t border-gray-100 pt-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="flex flex-1 items-center justify-center gap-1.5 rounded-md bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <x-admin.delete-button
                                :action="route('admin.products.destroy', $product->id)"
                                title="Hapus Produk?"
                                :confirm="'Hapus produk \''.$product->name.'\'? Tindakan ini tidak bisa dibatalkan.'"
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
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Produk</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Harga</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Stok</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-50/60">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ storageUrl($product->thumbnail, 'images/no-image.png') }}"
                                                alt="{{ $product->name }}" class="h-11 w-11 shrink-0 rounded-lg border border-gray-200 object-cover">
                                            <div class="min-w-0">
                                                <p class="truncate font-medium text-gray-900">{{ $product->name }}</p>
                                                <p class="truncate text-xs text-gray-400">{{ $product->sku }}</p>
                                            </div>
                                            @if ($product->is_featured)
                                                <span class="shrink-0 rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-600">Unggulan</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $product->category->name ?? '—' }}</td>
                                    <td class="px-4 py-3 text-gray-900">
                                        {{ rupiah($product->price) }}
                                        @if ($product->discount_price)
                                            <div class="text-xs text-emerald-600">Diskon: {{ rupiah($product->discount_price) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($product->stock > 0)
                                            <span class="text-gray-700">{{ $product->stock }}</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700">Habis</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($product->is_active)
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
                                            <x-admin.delete-button
                                                :action="route('admin.products.destroy', $product->id)"
                                                title="Hapus Produk?"
                                                :confirm="'Hapus produk \''.$product->name.'\'? Tindakan ini tidak bisa dibatalkan.'"
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

        <div>{{ $products->links() }}</div>
    </div>
</x-admin.layout>
