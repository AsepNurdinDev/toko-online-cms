<x-admin.layout title="Edit Banner">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Edit Banner
        </h2>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <div class="mb-4">
            <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke daftar banner
            </a>
        </div>

        <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
            @csrf
            @method('PUT')

            <div>
                <x-admin.input-label for="title" value="Judul Banner (opsional)" />
                <x-admin.text-input id="title" name="title" type="text" class="mt-1 block w-full"
                    :value="old('title', $banner->title)" autofocus />
                <p class="mt-1 text-xs text-gray-400">Kosongkan kalau gambar banner sudah cukup jelas tanpa teks — supaya tidak menutupi foto.</p>
                <x-admin.input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <x-admin.input-label for="subtitle" value="Subjudul (opsional)" />
                <x-admin.text-input id="subtitle" name="subtitle" type="text" class="mt-1 block w-full"
                    :value="old('subtitle', $banner->subtitle)" />
                <x-admin.input-error class="mt-2" :messages="$errors->get('subtitle')" />
            </div>

            <div>
                <x-admin.input-label for="image" value="Gambar Banner" />
                <div class="mt-2">
                    <x-admin.image-upload
                        name="image"
                        :current="storageUrl($banner->image)"
                        shape="banner"
                        change-label="Ganti Gambar"
                        hint="Disarankan rasio 21:7, format JPG/PNG/WEBP, maks. 8MB (otomatis dikompres di server)."
                        :errors="$errors->get('image')"
                    />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <x-admin.input-label for="button_text" value="Teks Tombol (opsional)" />
                    <x-admin.text-input id="button_text" name="button_text" type="text" class="mt-1 block w-full"
                        :value="old('button_text', $banner->button_text)" maxlength="50" />
                    <x-admin.input-error class="mt-2" :messages="$errors->get('button_text')" />
                </div>
                <div>
                    <x-admin.input-label for="button_link" value="Tautan Tombol (opsional)" />
                    <x-admin.text-input id="button_link" name="button_link" type="url" class="mt-1 block w-full"
                        :value="old('button_link', $banner->button_link)" placeholder="https://" />
                    <x-admin.input-error class="mt-2" :messages="$errors->get('button_link')" />
                </div>
            </div>

            <div>
                <x-admin.input-label for="sort_order" value="Urutan Tampil" />
                <x-admin.text-input id="sort_order" name="sort_order" type="number" min="0" class="mt-1 block w-full sm:w-40"
                    :value="old('sort_order', $banner->sort_order)" required />
                <x-admin.input-error class="mt-2" :messages="$errors->get('sort_order')" />
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $banner->is_active))
                    class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                <label for="is_active" class="text-sm text-gray-700">Tampilkan banner ini</label>
                <x-admin.input-error class="mt-2" :messages="$errors->get('is_active')" />
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.banners.index') }}" class="rounded-md px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100">Batal</a>
                <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin.layout>
