<header class="sticky top-0 z-50 border-b border-zinc-800 bg-zinc-950/95 text-zinc-100 backdrop-blur-md shadow-xl" x-data="{ mobileMenu: false }">
    <div class="mx-auto flex h-20 max-w-7xl items-center gap-4 px-4 sm:px-6 lg:px-8">

        <!-- Logo / Brand -->
        <a href="{{ route('shop.home') }}" class="flex shrink-0 items-center gap-3 group">
            @if (setting('logo'))
                <img src="{{ storageUrl(setting('logo')) }}" alt="{{ setting('site_name') }}" class="h-10 w-10 object-contain filtering brightness-110">
            @else
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 font-black text-black shadow-lg shadow-orange-500/20 group-hover:scale-105 transition duration-300">
                    {{ Illuminate\Support\Str::upper(Illuminate\Support\Str::substr(setting('site_name', 'H'), 0, 1)) }}
                </span>
            @endif
            <div class="flex flex-col">
                <span class="text-xl font-black uppercase tracking-wider text-white italic">
                    {{ setting('site_name', config('app.name')) }}
                </span>
                <span class="text-[9px] uppercase tracking-widest text-orange-500 font-bold -mt-1">Kustom Riders Hub</span>
            </div>
        </a>

        <!-- Search Bar (Desktop) -->
        <form method="GET" action="{{ route('shop.products') }}" class="hidden flex-1 max-w-lg md:block ml-6">
            <div class="relative">
                <svg class="pointer-events-none absolute left-3.5 top-3 h-4 w-4 text-zinc-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari sparepart atau apparel..."
                    class="w-full rounded-lg border-zinc-800 bg-zinc-900 pl-10 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-500 focus:bg-zinc-900 focus:ring-orange-500 transition duration-300">
            </div>
        </form>

        <!-- Navigation Links (Desktop) -->
        <nav class="ml-auto hidden items-center gap-8 text-xs font-black uppercase tracking-widest md:flex">
            <a href="{{ route('shop.home') }}" class="transition duration-300 {{ request()->routeIs('shop.home') ? 'text-orange-500' : 'text-zinc-300 hover:text-orange-500' }}">Beranda</a>
            <a href="{{ route('shop.products') }}" class="transition duration-300 {{ request()->routeIs('shop.products') ? 'text-orange-500' : 'text-zinc-300 hover:text-orange-500' }}">Semua Produk</a>
            
            @if (setting('whatsapp'))
                <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-orange-500 to-amber-600 px-5 py-2.5 text-black shadow-md transition hover:from-orange-600 hover:to-amber-700 hover:scale-105 duration-300">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.15-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 5.001L2 22l5.117-1.341a9.958 9.958 0 0 0 4.887 1.244h.004c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.181-2.929-7.07a9.935 9.935 0 0 0-7.072-2.833zm0 18.187h-.003a8.184 8.184 0 0 1-4.166-1.14l-.299-.177-3.037.796.81-2.96-.194-.304a8.176 8.176 0 0 1-1.255-4.375c0-4.523 3.68-8.203 8.204-8.203a8.15 8.15 0 0 1 5.802 2.405 8.15 8.15 0 0 1 2.399 5.803c0 4.524-3.68 8.203-8.204 8.203z"/></svg>
                    Order Sekarang
                </a>
            @endif
        </nav>

        <!-- Hamburger Button (Mobile) -->
        <button @click="mobileMenu = !mobileMenu" class="ml-auto rounded-lg p-2 text-zinc-400 hover:bg-zinc-900 hover:text-orange-500 md:hidden transition duration-300" aria-label="Menu">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="mobileMenu" x-transition @click.away="mobileMenu = false" class="border-t border-zinc-900 bg-zinc-950 px-4 py-5 md:hidden space-y-4" style="display:none;">
        <form method="GET" action="{{ route('shop.products') }}">
            <div class="relative">
                <svg class="pointer-events-none absolute left-3.5 top-2.5 h-4 w-4 text-zinc-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                    class="w-full rounded-lg border-zinc-800 bg-zinc-900 pl-10 text-sm text-zinc-200 focus:border-orange-500 focus:bg-zinc-900 focus:ring-orange-500">
            </div>
        </form>
        <div class="flex flex-col gap-3 text-xs font-black uppercase tracking-widest pl-2">
            <a href="{{ route('shop.home') }}" class="py-1 {{ request()->routeIs('shop.home') ? 'text-orange-500' : 'text-zinc-300' }}">Beranda</a>
            <a href="{{ route('shop.products') }}" class="py-1 {{ request()->routeIs('shop.products') ? 'text-orange-500' : 'text-zinc-300' }}">Semua Produk</a>
            @if (setting('whatsapp'))
                <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener" class="font-black text-orange-500 py-1 tracking-widest">Order via WhatsApp &rarr;</a>
            @endif
        </div>
    </div>
</header>