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
    
    <!-- Beri ID yang unik dan tambahkan alt text yang jelas -->
    <img id="product-thumbnail-preview" src="https://placehold.co/400x300?text=Belum+Ada+Gambar" class="mb-3 aspect-square w-full rounded-lg border border-gray-200 object-cover">
    
    <label for="thumbnail" class="block w-full cursor-pointer rounded-md border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
        Pilih Gambar
    </label>
    
    <!-- Hapus onchange inline, kita handle di bawah -->
    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="hidden">
    
    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
</div>

<!-- Tambahkan script ini di bagian bawah file blade Anda -->
<script>
    document.getElementById('thumbnail').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('product-thumbnail-preview');
        
        if (file) {
            // Memastikan yang diupload benar-benar gambar
            if (file.type.startsWith('image/')) {
                preview.src = URL.createObjectURL(file);
            } else {
                alert('File yang dipilih harus berupa gambar!');
                this.value = ''; // Reset input file jika bukan gambar
            }
        }
    });
</script>

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
    </div>
</x-admin-layout>
