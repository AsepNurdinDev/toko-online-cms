@props([
    'name' => 'gallery',       // dikirim sebagai gallery[] (array file)
    'hint' => 'Bisa pilih beberapa foto sekaligus. Format JPG/PNG/WEBP, maks 8MB per foto (otomatis dikompres di server).',
])

<div
    x-data="{
        files: [],
        maxBytes: 8 * 1024 * 1024, // 8MB, harus selaras dengan rule 'max:8192' di server
        sizeError: null,
        addFiles(event) {
            const picked = Array.from(event.target.files).filter(f => f.type.startsWith('image/'));
            const tooBig = picked.filter(f => f.size > this.maxBytes);
            const okFiles = picked.filter(f => f.size <= this.maxBytes);

            this.sizeError = tooBig.length
                ? tooBig.length + ' foto dilewati karena ukurannya lebih dari 8MB: ' + tooBig.map(f => f.name).join(', ')
                : null;

            this.files = [...this.files, ...okFiles];
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

    <div x-show="sizeError" x-transition style="display: none;" class="mt-2 flex items-start gap-2 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700">
        <svg class="mt-0.5 h-4 w-4 shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span x-text="sizeError"></span>
    </div>
</div>
