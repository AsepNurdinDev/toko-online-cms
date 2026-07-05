<x-admin-layout title="Pengaturan">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Pengaturan Toko
        </h2>
    </x-slot>

    <div class="mx-auto max-w-3xl">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Informasi Toko -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-base font-semibold text-gray-900">Informasi Toko</h3>
                <p class="mt-1 text-sm text-gray-500">Informasi ini akan tampil di halaman utama toko.</p>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-input-label for="site_name" value="Nama Toko" />
                        <x-text-input id="site_name" name="site_name" type="text" class="mt-1 block w-full"
                            :value="old('site_name', $settings['site_name'] ?? config('app.name'))" required autofocus maxlength="100" />
                        <x-input-error class="mt-2" :messages="$errors->get('site_name')" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="site_description" value="Deskripsi Singkat" />
                        <textarea id="site_description" name="site_description" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Contoh: Belanja mudah, kirim cepat, harga bersahabat.">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('site_description')" />
                    </div>

                    <div>
                        <x-input-label for="whatsapp" value="Nomor WhatsApp Pemesanan" />
                        <x-text-input id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full"
                            placeholder="628123456789" :value="old('whatsapp', $settings['whatsapp'] ?? '')" required />
                        <p class="mt-1 text-xs text-gray-400">Gunakan format 62xxxxxxxxxx tanpa spasi/simbol. Semua pesanan pelanggan akan masuk ke nomor ini.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email (opsional)" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $settings['email'] ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="address" value="Alamat (opsional)" />
                        <textarea id="address" name="address" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('address', $settings['address'] ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>
            </div>

            <!-- Tampilan Beranda -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-base font-semibold text-gray-900">Tampilan Beranda</h3>
                <p class="mt-1 text-sm text-gray-500">Teks ini tampil jika belum ada banner yang diunggah.</p>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="hero_title" value="Judul Utama" />
                        <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full"
                            :value="old('hero_title', $settings['hero_title'] ?? '')" maxlength="150" />
                        <x-input-error class="mt-2" :messages="$errors->get('hero_title')" />
                    </div>
                    <div>
                        <x-input-label for="hero_subtitle" value="Subjudul" />
                        <x-text-input id="hero_subtitle" name="hero_subtitle" type="text" class="mt-1 block w-full"
                            :value="old('hero_subtitle', $settings['hero_subtitle'] ?? '')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('hero_subtitle')" />
                    </div>
                </div>
            </div>

            <!-- Logo & Favicon -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-base font-semibold text-gray-900">Logo &amp; Favicon</h3>
                <p class="mt-1 text-sm text-gray-500">Format gambar, maks. 2MB untuk logo dan 1MB untuk favicon.</p>

                <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <x-admin.image-upload
                        name="logo"
                        :current="!empty($settings['logo']) ? storageUrl($settings['logo']) : null"
                        label="Pilih Logo"
                        :errors="$errors->get('logo')"
                    />

                    <x-admin.image-upload
                        name="favicon"
                        :current="!empty($settings['favicon']) ? storageUrl($settings['favicon']) : null"
                        label="Pilih Favicon"
                        :errors="$errors->get('favicon')"
                    />
                </div>
            </div>

            <!-- Warna Tema -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8"
                x-data="{ color: '{{ old('theme_color', $settings['theme_color'] ?? '#f59e0b') }}' }">
                <h3 class="text-base font-semibold text-gray-900">Warna Tema Toko</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Warna ini otomatis dipakai di tombol, tautan aktif, dan aksen di seluruh halaman toko
                    (navbar, banner, kartu produk, footer) — cocok untuk mengustom tampilan sesuai brand tiap klien
                    tanpa perlu mengubah kode.
                </p>

                <div class="mt-5 flex flex-wrap items-center gap-3">
                    @foreach ([
                        'Amber' => '#f59e0b',
                        'Emerald' => '#10b981',
                        'Rose' => '#f43f5e',
                        'Biru' => '#3b82f6',
                        'Ungu' => '#8b5cf6',
                        'Zinc Gelap' => '#27272a',
                    ] as $presetName => $presetColor)
                        <button type="button" @click="color = '{{ $presetColor }}'"
                            class="group flex items-center gap-2 rounded-full border border-gray-200 py-1.5 pl-1.5 pr-3 text-xs font-medium text-gray-600 transition hover:border-gray-300"
                            :class="color === '{{ $presetColor }}' ? 'ring-2 ring-offset-1' : ''"
                            :style="color === '{{ $presetColor }}' ? 'ring-color: {{ $presetColor }}' : ''">
                            <span class="h-5 w-5 rounded-full border border-black/10" style="background-color: {{ $presetColor }}"></span>
                            {{ $presetName }}
                        </button>
                    @endforeach
                </div>

                <div class="mt-5 flex items-center gap-4">
                    <input type="color" x-model="color" name="theme_color"
                        class="h-12 w-16 cursor-pointer rounded-md border border-gray-300 p-1">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Atau pilih warna kustom sendiri</p>
                        <p class="text-xs text-gray-400" x-text="color"></p>
                    </div>
                    <a href="{{ route('shop.home') }}" target="_blank"
                        class="ml-auto inline-flex items-center gap-1.5 rounded-md border border-gray-300 px-3 py-2 text-xs font-medium text-gray-600 hover:bg-gray-50">
                        Pratinjau Toko &rarr;
                    </a>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('theme_color')" />
            </div>

            <!-- Media sosial -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-base font-semibold text-gray-900">Media Sosial</h3>
                <p class="mt-1 text-sm text-gray-500">Opsional, tautan akan tampil di footer toko.</p>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="facebook" value="Facebook" />
                        <x-text-input id="facebook" name="facebook" type="url" class="mt-1 block w-full"
                            :value="old('facebook', $settings['facebook'] ?? '')" placeholder="https://facebook.com/..." />
                        <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                    </div>
                    <div>
                        <x-input-label for="instagram" value="Instagram" />
                        <x-text-input id="instagram" name="instagram" type="url" class="mt-1 block w-full"
                            :value="old('instagram', $settings['instagram'] ?? '')" placeholder="https://instagram.com/..." />
                        <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                    </div>
                    <div>
                        <x-input-label for="tiktok" value="TikTok" />
                        <x-text-input id="tiktok" name="tiktok" type="url" class="mt-1 block w-full"
                            :value="old('tiktok', $settings['tiktok'] ?? '')" placeholder="https://tiktok.com/@..." />
                        <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
