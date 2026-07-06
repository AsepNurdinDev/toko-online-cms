{{--
    Dialog konfirmasi global untuk admin. Cukup taruh SEKALI di admin layout.
    Komponen lain memicu dialog ini lewat event 'open-confirm', contoh:

        $dispatch('open-confirm', {
            title: 'Hapus Produk?',
            message: 'Tindakan ini tidak bisa dibatalkan.',
            confirmLabel: 'Ya, Hapus',
            formId: 'id-form-yang-mau-disubmit',
        })

    Lihat components/admin/delete-button.blade.php untuk pemakaian siap pakai.
--}}
<div
    x-data="{
        open: false,
        title: 'Konfirmasi',
        message: 'Apakah Anda yakin?',
        confirmLabel: 'Ya, Lanjutkan',
        formId: null,
        confirming: false,
        submit() {
            if (!this.formId) { this.open = false; return; }
            this.confirming = true;
            document.getElementById(this.formId).submit();
        },
    }"
    x-on:open-confirm.window="
        open = true;
        confirming = false;
        title = $event.detail.title || 'Konfirmasi';
        message = $event.detail.message || 'Apakah Anda yakin?';
        confirmLabel = $event.detail.confirmLabel || 'Ya, Lanjutkan';
        formId = $event.detail.formId || null;
    "
    x-on:keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    style="display: none;"
>
    <div class="absolute inset-0 bg-gray-900/60" @click="open = false"></div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl"
        style="display: none;"
    >
        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-50 text-red-500">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <h3 class="mt-4 text-base font-semibold text-gray-900" x-text="title"></h3>
        <p class="mt-1.5 text-sm text-gray-500" x-text="message"></p>

        <div class="mt-6 flex gap-3">
            <button type="button" @click="open = false" :disabled="confirming"
                class="flex-1 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 disabled:opacity-50">
                Batal
            </button>
            <button type="button" @click="submit()" :disabled="confirming"
                class="flex-1 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 disabled:opacity-50">
                <span x-show="!confirming" x-text="confirmLabel" style="display:none;"></span>
                <span x-show="confirming" style="display:none;">Memproses...</span>
            </button>
        </div>
    </div>
</div>
