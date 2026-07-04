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
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Kategori" />
                            <select id="category_id" name="category_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="">Pilih kategori</option>
                                @foreach ($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? null) == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $product->description ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <x-input-label for="price" value="Harga (Rp)" />
                                <x-text-input id="price" name="price" type="number" min="0" step="1" class="mt-1 block w-full"
                                    :value="old('price', $product->price ?? 0)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                            <div>
                                <x-input-label for="stock" value="Stok" />
                                <x-text-input id="stock" name="stock" type="number" min="0" step="1" class="mt-1 block w-full"
                                    :value="old('stock', $product->stock ?? 0)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-base font-semibold text-gray-900">Gambar Produk</h3>
                    <img id="image-preview"
                        src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/400x300?text=%20' }}"
                        class="mb-3 aspect-square w-full rounded-lg border border-gray-200 object-cover">
                    <label for="image" class="block w-full cursor-pointer rounded-md border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Ganti Gambar
                    </label>
                    <input id="image" name="image" type="file" accept="image/*" class="hidden"
                        onchange="const f=this.files[0]; if(f){document.getElementById('image-preview').src=URL.createObjectURL(f);}">
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-3 text-base font-semibold text-gray-900">Status</h3>
                    <div class="flex items-center gap-3">
                        <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $product->is_active ?? true))
                            class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                        <label for="is_active" class="text-sm text-gray-700">Tampilkan produk ini di toko</label>
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
