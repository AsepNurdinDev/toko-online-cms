{{--
    Navbar toko. Warna aksen mengikuti tema (--shop-primary) yang diatur
    admin di halaman Pengaturan, jadi component ini TIDAK perlu diedit
    untuk ganti warna per klien. Kalau perlu ubah struktur/menu, edit di sini saja
    — perubahan otomatis berlaku di semua halaman yang pakai <x-shop.layout>.
--}}
<header class="sticky top-0 z-30 border-b border-gray-200 bg-white/90 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-4 sm:px-6 lg:px-8">

        <a href="{{ route('shop.home') }}" class="flex shrink-0 items-center gap-2">
            @if (setting('logo'))
                <img src="{{ storageUrl(setting('logo')) }}" alt="{{ setting('site_name') }}" class="h-9 w-9 rounded-lg object-contain">
            @else
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[var(--shop-primary)] text-sm font-bold text-white">
                    {{ Illuminate\Support\Str::upper(Illuminate\Support\Str::substr(setting('site_name', 'B'), 0, 1)) }}
                </span>
            @endif
            <span class="hidden text-lg font-bold tracking-tight text-gray-900 sm:block">{{ setting('site_name', config('app.name')) }}</span>
        </a>

        <!-- Search (desktop) -->
        <form method="GET" action="{{ route('shop.products') }}" class="hidden flex-1 max-w-xl md:block">
            <div class="relative">
                <svg class="pointer-events-none absolute left-3.5 top-2.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                    class="w-full rounded-full border-gray-200 bg-gray-100 pl-10 text-sm focus:border-[var(--shop-primary)] focus:bg-white focus:ring-[var(--shop-primary)]">
            </div>
        </form>

        <nav class="ml-auto hidden items-center gap-6 text-sm font-medium text-gray-700 md:flex">
            <a href="{{ route('shop.home') }}" class="hover:text-[var(--shop-primary)] {{ request()->routeIs('shop.home') ? 'text-[var(--shop-primary)]' : '' }}">Beranda</a>
            <a href="{{ route('shop.products') }}" class="hover:text-[var(--shop-primary)] {{ request()->routeIs('shop.products') ? 'text-[var(--shop-primary)]' : '' }}">Semua Produk</a>
            @if (setting('whatsapp'))
                <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-white shadow-sm transition hover:bg-emerald-600">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.15-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 5.001L2 22l5.117-1.341a9.958 9.958 0 0 0 4.887 1.244h.004c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.181-2.929-7.07a9.935 9.935 0 0 0-7.072-2.833zm0 18.187h-.003a8.184 8.184 0 0 1-4.166-1.14l-.299-.177-3.037.796.81-2.96-.194-.304a8.176 8.176 0 0 1-1.255-4.375c0-4.523 3.68-8.203 8.204-8.203a8.15 8.15 0 0 1 5.802 2.405 8.15 8.15 0 0 1 2.399 5.803c0 4.524-3.68 8.203-8.204 8.203z"/></svg>
                    Pesan
                </a>
            @endif
        </nav>

        <button @click="mobileMenu = !mobileMenu" class="ml-auto rounded-md p-2 text-gray-600 hover:bg-gray-100 md:hidden" aria-label="Menu">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenu" x-transition @click.away="mobileMenu = false" class="border-t border-gray-100 bg-white px-4 py-4 md:hidden" style="display:none;">
        <form method="GET" action="{{ route('shop.products') }}" class="mb-4">
            <div class="relative">
                <svg class="pointer-events-none absolute left-3.5 top-2.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                    class="w-full rounded-full border-gray-200 bg-gray-100 pl-10 text-sm focus:border-[var(--shop-primary)] focus:bg-white focus:ring-[var(--shop-primary)]">
            </div>
        </form>
        <div class="flex flex-col gap-3 text-sm font-medium text-gray-700">
            <a href="{{ route('shop.home') }}">Beranda</a>
            <a href="{{ route('shop.products') }}">Semua Produk</a>
            @if (setting('whatsapp'))
                <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener" class="font-semibold text-emerald-600">Pesan via WhatsApp</a>
            @endif
        </div>
    </div>
</header>
