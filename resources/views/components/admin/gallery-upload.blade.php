@props([
    'name' => 'gallery',       // dikirim sebagai gallery[] (array file)
    'hint' => 'Bisa pilih beberapa foto sekaligus. Format JPG/PNG/WEBP, maks 2MB per foto.',
])

<div
    x-data="{
        files: [],
        addFiles(event) {
            const picked = Array.from(event.target.files).filter(f => f.type.startsWith('image/'));
            this.files = [...this.files, ...picked];
            this.sync();
        },
        removeFile(index) {
            this.files.splice(index, 1);
            this.sync();
        },
        sync() {
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.input.files = dt.files;
        },
    }"
>
    <input
        x-ref="input"
        type="file"
        name="{{ $name }}[]"
        accept="image/*"
        multiple
        class="hidden"
        @change="addFiles($event)"
    >

    <!-- Grid pratinjau foto baru yang dipilih -->
    <div class="grid grid-cols-3 gap-3 sm:grid-cols-4" x-show="files.length > 0" style="display: none;">
        <template x-for="(file, index) in files" :key="index">
            <div class="group relative aspect-square overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                <img :src="URL.createObjectURL(file)" class="h-full w-full object-cover">
                <button type="button" @click="removeFile(index)"
                    class="absolute right-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-black/60 text-white opacity-0 transition group-hover:opacity-100"
                    title="Hapus dari daftar upload">
                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </template>
    </div>

    <button type="button" @click="$refs.input.click()"
        class="mt-3 inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span x-text="files.length > 0 ? 'Tambah Foto Lagi' : 'Tambah Foto'"></span>
    </button>

    <p class="mt-2 text-xs" :class="files.length > 0 ? 'text-emerald-600 font-medium' : 'text-gray-400'"
        x-text="files.length > 0 ? files.length + ' foto siap diupload — klik Simpan untuk mengunggah.' : '{{ $hint }}'">
    </p>
</div>
