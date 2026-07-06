@props([
    'name',
    'current' => null,       // URL foto yang sudah ada (kalau ada)
    'label' => 'Pilih Gambar',
    'changeLabel' => null,    // label tombol saat sudah ada foto, default "Ganti Gambar"
    'shape' => 'square',      // circle | square | banner
    'hint' => null,
    'required' => false,
    'errors' => null,         // $errors->get('field') dari controller
])

@php
    $shapeImgClass = match ($shape) {
        'circle' => 'h-20 w-20 rounded-full shrink-0',
        'banner' => 'aspect-[21/7] w-full rounded-lg',
        default => 'aspect-square w-full max-w-[220px] rounded-lg',
    };
    $isCircle = $shape === 'circle';
    $placeholderText = match ($shape) {
        'circle' => '%20',
        'banner' => 'Belum+ada+banner',
        default => 'Belum+ada+gambar',
    };
    $placeholderSize = $isCircle ? '160x160' : ($shape === 'banner' ? '640x210' : '400x400');
    $fallback = "https://placehold.co/{$placeholderSize}?text={$placeholderText}";
    $changeLabel = $changeLabel ?? ($current ? 'Ganti Gambar' : $label);
@endphp

<div
    x-data="{
        fileName: null,
        fileSize: null,
        previewUrl: @js($current ?: null),
        hasNew: false,
        errorMsg: null,
        onChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) {
                this.errorMsg = 'File yang dipilih harus berupa gambar (JPG, PNG, atau WEBP).';
                event.target.value = '';
                return;
            }
            this.errorMsg = null;
            this.fileName = file.name;
            this.fileSize = (file.size / 1024).toFixed(0) + ' KB';
            this.previewUrl = URL.createObjectURL(file);
            this.hasNew = true;
        },
        cancel() {
            this.$refs.input.value = '';
            this.fileName = null;
            this.hasNew = false;
            this.errorMsg = null;
            this.previewUrl = @js($current ?: null);
        },
    }"
    class="{{ $isCircle ? 'flex items-center gap-4' : '' }}"
>
    <div class="relative {{ $isCircle ? '' : 'mb-3' }}">
        <img
            :src="previewUrl || '{{ $fallback }}'"
            alt="Pratinjau gambar"
            class="{{ $shapeImgClass }} border border-gray-200 bg-gray-50 object-cover transition"
            :class="hasNew ? 'ring-2 ring-emerald-500 ring-offset-2' : ''"
        >

        <!-- Badge indikator: foto baru sudah dipilih -->
        <span
            x-show="hasNew"
            x-transition
            style="display: none;"
            class="absolute -right-1.5 -top-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-white shadow ring-2 ring-white"
            title="Foto baru dipilih"
        >
            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
    </div>

    <div class="{{ $isCircle ? '' : 'w-full' }}">
        <input
            x-ref="input"
            id="{{ $name }}"
            name="{{ $name }}"
            type="file"
            accept="image/*"
            class="hidden"
            @change="onChange($event)"
            {{ $required ? 'required' : '' }}
        >

        <label for="{{ $name }}"
            class="inline-flex cursor-pointer items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 7.5L12 3m0 0L7.5 7.5M12 3v13.5" />
            </svg>
            <span x-text="hasNew ? 'Ganti Gambar' : '{{ $changeLabel }}'"></span>
        </label>

        <!-- Status jelas: apakah foto sudah dipilih untuk diupload atau belum -->
        <div x-show="hasNew" x-transition style="display: none;" class="mt-2 flex items-start gap-2 rounded-md border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-800">
            <svg class="mt-0.5 h-4 w-4 shrink-0 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3 6-6M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="flex-1 min-w-0">
                Foto baru dipilih: <span class="font-semibold" x-text="fileName"></span>
                <span class="text-emerald-600" x-text="fileSize ? '(' + fileSize + ')' : ''"></span>
                — klik <strong>Simpan</strong> di bawah untuk mengunggahnya.
            </span>
            <button type="button" @click="cancel()" class="shrink-0 font-medium text-emerald-700 underline hover:text-emerald-900">
                Batal
            </button>
        </div>

        <div x-show="!hasNew && !errorMsg" class="mt-2 text-xs text-gray-500">
            @if ($current)
                Foto saat ini sudah tersimpan. Pilih gambar baru untuk menggantinya.
            @else
                Belum ada foto yang diunggah.
            @endif
        </div>

        <div x-show="errorMsg" x-transition style="display: none;" class="mt-2 flex items-start gap-2 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700">
            <svg class="mt-0.5 h-4 w-4 shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="errorMsg"></span>
        </div>

        @if ($hint)
            <p class="mt-1 text-xs text-gray-400">{{ $hint }}</p>
        @endif

        @if ($errors)
            <x-admin.input-error class="mt-2" :messages="$errors" />
        @endif
    </div>
</div>
