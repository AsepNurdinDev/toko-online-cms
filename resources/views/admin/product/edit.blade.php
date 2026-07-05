<x-admin-layout title="Edit Produk">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Edit Produk
        </h2>
    </x-slot>

    <div class="mx-auto max-w-4xl">
        <div class="mb-4">
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke daftar produk
            </a>
        </div>

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            @csrf
            @method('PUT')

            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                    <h3 class="mb-4 text-base font-semibold text-gray-900">Informasi Produk</h3>

                    <div class="space-y-5">
                        <div>
                            <x-input-label for="name" value="Nama Produk" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $product->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            <p class="mt-1 text-xs text-gray-400">SKU: {{ $product->sku }}</p>
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Kategori" />
                            <select id="category_id" name="category_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="">Pilih kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $product->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <x-input-label for="price" value="Harga Normal (Rp)" />
                                <x-text-input id="price" name="price" type="number" min="0" step="1" class="mt-1 block w-full"
                                    :value="old('price', $product->price)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                            <div>
                                <x-input-label for="discount_price" value="Harga Diskon (opsional)" />
                                <x-text-input id="discount_price" name="discount_price" type="number" min="0" step="1" class="mt-1 block w-full"
                                    :value="old('discount_price', $product->discount_price)" placeholder="Kosongkan jika tidak ada diskon" />
                                <x-input-error class="mt-2" :messages="$errors->get('discount_price')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <x-text-input id="stock" name="stock" type="number" min="0" step="1" class="mt-1 block w-full sm:w-48"
                                :value="old('stock', $product->stock)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-base font-semibold text-gray-900">Foto Produk</h3>
                    <x-admin.image-upload
                        name="thumbnail"
                        :current="$product->thumbnail ? storageUrl($product->thumbnail) : null"
                        label="Pilih Gambar"
                        change-label="Ganti Gambar"
                        :errors="$errors->get('thumbnail')"
                    />
                    <p class="mt-2 text-xs text-gray-400">Foto ini yang tampil di kartu produk & daftar toko.</p>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-1 text-base font-semibold text-gray-900">Galeri Foto Tambahan</h3>
                    <p class="mb-4 text-xs text-gray-500">Tampil di halaman detail produk agar pembeli bisa lihat dari berbagai sisi.</p>

                    @if (($product->images ?? collect())->isNotEmpty())
                        <div class="mb-4 grid grid-cols-3 gap-3 sm:grid-cols-4">
                            @foreach ($product->images as $image)
                                <div class="group relative aspect-square overflow-hidden rounded-lg border border-gray-200">
                                    <img src="{{ storageUrl($image->image) }}" class="h-full w-full object-cover">
                                    <button type="submit" form="delete-img-{{ $image->id }}"
                                        onclick="return confirm('Hapus foto ini dari galeri?')"
                                        class="absolute right-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-black/60 text-white opacity-0 transition group-hover:opacity-100"
                                        title="Hapus foto ini">
                                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <x-admin.gallery-upload name="gallery" />
                    <x-input-error class="mt-2" :messages="collect($errors->get('gallery.*'))->flatten()->all()" />
                </div>

                <div class="space-y-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-gray-900">Status</h3>
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_active" value="0">
                        <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $product->is_active))
                            class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                        <label for="is_active" class="text-sm text-gray-700">Tampilkan produk ini di toko</label>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_featured" value="0">
                        <input id="is_featured" name="is_featured" type="checkbox" value="1" @checked(old('is_featured', $product->is_featured))
                            class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                        <label for="is_featured" class="text-sm text-gray-700">Jadikan produk unggulan</label>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full rounded-md bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="w-full rounded-md px-5 py-2.5 text-center text-sm font-medium text-gray-600 hover:bg-gray-100">
                        Batal
                    </a>
                </div>
            </div>
        </form>

        {{-- Form tersembunyi untuk hapus per-foto galeri. Tidak bisa ditaruh nested di dalam
             form utama (HTML tidak mengizinkan <form> di dalam <form>), jadi tombol hapus di
             atas menunjuk ke sini lewat atribut form="delete-img-{id}". --}}
        @foreach ($product->images ?? [] as $image)
            <form id="delete-img-{{ $image->id }}" method="POST"
                action="{{ route('admin.products.images.destroy', [$product, $image]) }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>
</x-admin-layout>
