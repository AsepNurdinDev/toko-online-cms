<nav x-data="{ mobileMenu: false }"
    class="sticky top-0 z-50 border-b border-[var(--brass-500,#b08d57)]/20 bg-white shadow-sm">
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center gap-4">

            <!-- Logo / Site name -->
            <a href="{{ route('shop.home') }}" class="flex shrink-0 items-center gap-2 font-display text-2xl tracking-widest text-rust-600 lg:text-3xl">
                @if (setting('logo'))
                   <img src="{{ storageUrl(setting('logo')) }}" alt="{{ setting('site_name') }}" class="h-10 w-10 rounded-full object-cover">
                @endif
                <span>{{ setting('site_name', config('app.name')) }}</span>
            </a>

            <!-- Search (desktop) — langsung di baris yang sama, bukan baris terpisah di bawah -->
            <form method="GET" action="{{ route('shop.products') }}" class="hidden flex-1 md:block">
                <div class="relative mx-auto max-w-sm">
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                        class="w-full rounded-full border border-gray-300 bg-white py-2 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-500 shadow-sm focus:border-rust-600 focus:outline-none focus:ring-1 focus:ring-rust-600">
                </div>
            </form>

            <!-- Desktop nav -->
            <div class="hidden shrink-0 items-center gap-6 md:flex lg:gap-8">
                <a href="{{ route('shop.home') }}"
                    class="border-b-2 pb-1 text-sm font-medium transition
                    {{ request()->routeIs('shop.home')
                        ? 'border-rust-600 text-rust-600'
                        : 'border-transparent text-gray-700 hover:text-rust-600' }}">
                    Beranda
                </a>

                <a href="{{ route('shop.products') }}"
                    class="border-b-2 pb-1 text-sm font-medium transition
                    {{ request()->routeIs('shop.products')
                        ? 'border-rust-600 text-rust-600'
                        : 'border-transparent text-gray-700 hover:text-rust-600' }}">
                    Produk
                </a>

                <a href="{{ route('shop.profile') }}"
                    class="border-b-2 pb-1 text-sm font-medium transition
                    {{ request()->routeIs('shop.profile')
                        ? 'border-rust-600 text-rust-600'
                        : 'border-transparent text-gray-700 hover:text-rust-600' }}">
                    Profil
                </a>

                <a href="{{ route('shop.layanan') }}"
                    class="border-b-2 pb-1 text-sm font-medium transition
                    {{ request()->routeIs('shop.layanan')
                        ? 'border-rust-600 text-rust-600'
                        : 'border-transparent text-gray-700 hover:text-rust-600' }}">
                    Layanan
                </a>

                <a href="{{ route('shop.kontak') }}"
                    class="border-b-2 pb-1 text-sm font-medium transition
                    {{ request()->routeIs('shop.kontak')
                        ? 'border-rust-600 text-rust-600'
                        : 'border-transparent text-gray-700 hover:text-rust-600' }}">
                    Kontak
                </a>

                @if (setting('whatsapp'))
                    <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-600">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.15-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 5.001L2 22l5.117-1.341a9.958 9.958 0 0 0 4.887 1.244h.004c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.181-2.929-7.07a9.935 9.935 0 0 0-7.072-2.833zm0 18.187h-.003a8.184 8.184 0 0 1-4.166-1.14l-.299-.177-3.037.796.81-2.96-.194-.304a8.176 8.176 0 0 1-1.255-4.375c0-4.523 3.68-8.203 8.204-8.203a8.15 8.15 0 0 1 5.802 2.405 8.15 8.15 0 0 1 2.399 5.803c0 4.524-3.68 8.203-8.204 8.203z"/></svg>
                        Pesan
                    </a>
                @endif
            </div>

            <!-- Mobile controls: cuma hamburger -->
            <button @click="mobileMenu = !mobileMenu" :aria-expanded="mobileMenu" aria-label="Buka menu"
                class="relative ml-auto flex h-10 w-10 shrink-0 items-center justify-center rounded-md border border-gray-300 transition hover:bg-gray-100 md:hidden">
                <svg class="absolute h-5 w-5 text-gray-700 transition-all duration-300"
                    :class="mobileMenu ? 'rotate-90 opacity-0 scale-75' : 'rotate-0 opacity-100 scale-100'"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg class="absolute h-5 w-5 text-gray-700 transition-all duration-300"
                    :class="mobileMenu ? 'rotate-0 opacity-100 scale-100' : '-rotate-90 opacity-0 scale-75'"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{--
            Menu mobile dibuat "absolute" (mengambang di atas konten), BUKAN mengalir normal
            di bawah nav — supaya saat dibuka, dia menutupi/mengambang di atas hero, bukan
            mendorong hero turun ke bawah.
        --}}
        <div x-show="mobileMenu"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="mobileMenu = false"
            class="absolute inset-x-0 top-full z-40 border-t border-gray-100 bg-white px-4 py-4 shadow-lg md:hidden"
            style="display:none;">
            <form method="GET" action="{{ route('shop.products') }}" class="mb-3">
                <div class="relative">
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                        class="w-full rounded-full border border-gray-300 bg-white py-2 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-500 shadow-sm focus:border-rust-600 focus:outline-none focus:ring-1 focus:ring-rust-600">
                </div>
            </form>

            <div class="flex flex-col gap-1">
                <a href="{{ route('shop.home') }}" @click="mobileMenu = false"
                    class="rounded px-3 py-2.5 font-medium transition {{ request()->routeIs('shop.home') ? 'bg-[var(--brass-500,#b08d57)]/10 text-rust-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Beranda
                </a>
                <a href="{{ route('shop.products') }}" @click="mobileMenu = false"
                    class="rounded px-3 py-2.5 font-medium transition {{ request()->routeIs('shop.products') ? 'bg-[var(--brass-500,#b08d57)]/10 text-rust-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Produk
                </a>
                <a href="{{ route('shop.profile') }}" @click="mobileMenu = false"
                    class="rounded px-3 py-2.5 font-medium transition {{ request()->routeIs('shop.profile') ? 'bg-[var(--brass-500,#b08d57)]/10 text-rust-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Profil
                </a>
                <a href="{{ route('shop.layanan') }}" @click="mobileMenu = false"
                    class="rounded px-3 py-2.5 font-medium transition {{ request()->routeIs('shop.layanan') ? 'bg-[var(--brass-500,#b08d57)]/10 text-rust-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Layanan
                </a>
                <a href="{{ route('shop.kontak') }}" @click="mobileMenu = false"
                    class="rounded px-3 py-2.5 font-medium transition {{ request()->routeIs('shop.kontak') ? 'bg-[var(--brass-500,#b08d57)]/10 text-rust-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Kontak
                </a>

                @if (setting('whatsapp'))
                    <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener" @click="mobileMenu = false"
                        class="mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-emerald-500 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-600">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.15-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 5.001L2 22l5.117-1.341a9.958 9.958 0 0 0 4.887 1.244h.004c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.181-2.929-7.07a9.935 9.935 0 0 0-7.072-2.833zm0 18.187h-.003a8.184 8.184 0 0 1-4.166-1.14l-.299-.177-3.037.796.81-2.96-.194-.304a8.176 8.176 0 0 1-1.255-4.375c0-4.523 3.68-8.203 8.204-8.203a8.15 8.15 0 0 1 5.802 2.405 8.15 8.15 0 0 1 2.399 5.803c0 4.524-3.68 8.203-8.204 8.203z"/></svg>
                        Pesan via WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>