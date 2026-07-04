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
                <p class="mt-1 text-sm text-gray-500">Informasi ini akan tampil di halaman utama dan struk pesanan.</p>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-input-label for="site_name" value="Nama Toko" />
                        <x-text-input id="site_name" name="site_name" type="text" class="mt-1 block w-full"
                            :value="old('site_name', $setting->site_name ?? config('app.name'))" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('site_name')" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="tagline" value="Tagline / Deskripsi Singkat" />
                        <textarea id="tagline" name="tagline" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Contoh: Belanja mudah, kirim cepat, harga bersahabat.">{{ old('tagline', $setting->tagline ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('tagline')" />
                    </div>

                    <div>
                        <x-input-label for="site_email" value="Email" />
                        <x-text-input id="site_email" name="site_email" type="email" class="mt-1 block w-full"
                            :value="old('site_email', $setting->site_email ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('site_email')" />
                    </div>

                    <div>
                        <x-input-label for="site_phone" value="No. Telepon / WhatsApp" />
                        <x-text-input id="site_phone" name="site_phone" type="text" class="mt-1 block w-full"
                            placeholder="62812xxxxxxx" :value="old('site_phone', $setting->site_phone ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('site_phone')" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="site_address" value="Alamat" />
                        <textarea id="site_address" name="site_address" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('site_address', $setting->site_address ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('site_address')" />
                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-base font-semibold text-gray-900">Logo</h3>
                <p class="mt-1 text-sm text-gray-500">Format PNG/JPG, disarankan latar transparan, maks. 2MB.</p>

                <div class="mt-4 flex items-center gap-5">
                    <img
                        id="logo-preview"
                        src="{{ isset($setting->logo) && $setting->logo ? asset('storage/'.$setting->logo) : 'https://placehold.co/96x96?text=Logo' }}"
                        alt="Logo saat ini"
                        class="h-20 w-20 rounded-lg border border-gray-200 object-contain bg-white"
                    >
                    <div>
                        <label for="logo" class="inline-flex cursor-pointer items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
                            Pilih Gambar
                        </label>
                        <input id="logo" name="logo" type="file" accept="image/*" class="hidden"
                            onchange="const f=this.files[0]; if(f){document.getElementById('logo-preview').src = URL.createObjectURL(f);}">
                        <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                    </div>
                </div>
            </div>

            <!-- Media sosial -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-base font-semibold text-gray-900">Media Sosial</h3>
                <p class="mt-1 text-sm text-gray-500">Opsional, tautan akan tampil di footer.</p>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="facebook_url" value="Facebook" />
                        <x-text-input id="facebook_url" name="facebook_url" type="url" class="mt-1 block w-full"
                            :value="old('facebook_url', $setting->facebook_url ?? '')" />
                    </div>
                    <div>
                        <x-input-label for="instagram_url" value="Instagram" />
                        <x-text-input id="instagram_url" name="instagram_url" type="url" class="mt-1 block w-full"
                            :value="old('instagram_url', $setting->instagram_url ?? '')" />
                    </div>
                    <div>
                        <x-input-label for="whatsapp_url" value="Link WhatsApp" />
                        <x-text-input id="whatsapp_url" name="whatsapp_url" type="url" class="mt-1 block w-full"
                            placeholder="https://wa.me/62812xxxxxxx" :value="old('whatsapp_url', $setting->whatsapp_url ?? '')" />
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
