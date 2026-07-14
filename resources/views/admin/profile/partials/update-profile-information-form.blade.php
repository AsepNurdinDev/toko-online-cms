<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui nama, username, email, dan foto profil akun Anda.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <x-admin.image-upload
            name="photo"
            :current="$user->photo ? storageUrl($user->photo) : null"
            shape="circle"
            change-label="Ganti Foto"
            :errors="$errors->get('photo')"
            hint="Format JPG/PNG/WEBP, maks. 8MB."
        />

        <div>
            <x-admin.input-label for="name" :value="__('Nama')" />
            <x-admin.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-admin.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-admin.input-label for="username" :value="__('Username')" />
            <x-admin.text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-admin.input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-admin.input-label for="email" :value="__('Email')" />
            <x-admin.text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-admin.input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-admin.primary-button>{{ __('Simpan') }}</x-admin.primary-button>

            @if (session('success'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
