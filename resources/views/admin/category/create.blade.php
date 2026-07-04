<x-admin-layout title="Tambah Kategori">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Tambah Kategori
        </h2>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke daftar kategori
            </a>
        </div>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6 rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
            @csrf

            <div>
                <x-input-label for="name" value="Nama Kategori" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name')" required autofocus maxlength="100" placeholder="Contoh: Elektronik" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" value="Deskripsi (opsional)" />
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                    placeholder="Deskripsi singkat kategori ini">{{ old('description') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input id="is_active" name="is_active" type="checkbox" value="1" checked
                    class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                <label for="is_active" class="text-sm text-gray-700">Aktifkan kategori ini</label>
                <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.categories.index') }}" class="rounded-md px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100">Batal</a>
                <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
