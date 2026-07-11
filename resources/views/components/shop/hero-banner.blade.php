@props(['banners'])

@if ($banners->isNotEmpty())
    <section class="relative overflow-hidden bg-white dark:bg-gray-900" x-data="{ active: 0, total: {{ $banners->count() }} }"
        @if ($banners->count() > 1) x-init="setInterval(() => active = (active + 1) % total, 5000)" @endif>

        {{--
            Mobile dan desktop sengaja dipisah jadi 2 blok yang berdiri sendiri (bukan 1 struktur
            yang tukar posisi relative/absolute per breakpoint). Ini lebih aman: masing-masing
            blok tidak bergantung pada tinggi/posisi blok yang lain, jadi tidak ada rantai CSS
            yang bisa putus di salah satu ukuran layar.
        --}}

        <!-- ======================= MOBILE (< sm): alur natural, gambar lalu teks di bawah ======================= -->
        <div class="sm:hidden">
            @foreach ($banners as $index => $banner)
                @php $hasText = $banner->title || $banner->subtitle || $banner->button_text; @endphp
                <div x-show="active === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    style="{{ $index === 0 ? '' : 'display:none;' }}">

                    <div class="relative aspect-[4/3] w-full overflow-hidden">
                        <img src="{{ storageUrl($banner->image) }}" alt="{{ $banner->title ?: 'Banner' }}"
                            class="h-full w-full object-cover object-center">

                        @if ($banners->count() > 1)
                            <div class="absolute bottom-2 left-1/2 z-10 flex -translate-x-1/2 gap-1.5">
                                @foreach ($banners as $dotIndex => $dotBanner)
                                    <button @click="active = {{ $dotIndex }}" aria-label="Slide {{ $dotIndex + 1 }}"
                                        :class="active === {{ $dotIndex }} ? 'w-5 bg-[#25D366]' : 'w-1.5 bg-white/70'"
                                        class="h-1.5 rounded-full transition-all duration-300"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if ($hasText)
                        <div class="bg-gray-50 p-5 text-gray-900 dark:bg-gray-800 dark:text-white">
                            <div class="max-w-md text-left">
                                @if ($banner->title)
                                    <h2 class="line-clamp-2 text-xl font-extrabold leading-tight tracking-tight">
                                        {{ $banner->title }}
                                    </h2>
                                @endif

                                @if ($banner->subtitle)
                                    <p class="mt-2 line-clamp-2 text-xs text-gray-600 dark:text-gray-300">
                                        {{ $banner->subtitle }}
                                    </p>
                                @endif

                                @if ($banner->button_text)
                                    <a href="{{ $banner->button_link ?: route('shop.products') }}"
                                        class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#25D366] py-3 text-sm font-bold text-white shadow-md transition hover:bg-[#20ba59] active:scale-[0.98]">
                                        {{ $banner->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- ======================= DESKTOP (sm ke atas): overlay di atas gambar ======================= -->
        <div class="relative hidden sm:block sm:aspect-[16/9] md:aspect-[21/9] lg:aspect-[3/1]">
            @foreach ($banners as $index => $banner)
                @php $hasText = $banner->title || $banner->subtitle || $banner->button_text; @endphp
                <div x-show="active === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="absolute inset-0"
                    style="{{ $index === 0 ? '' : 'display:none;' }}">

                    <img src="{{ storageUrl($banner->image) }}" alt="{{ $banner->title ?: 'Banner' }}"
                        class="h-full w-full object-cover object-center">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/20 to-transparent"></div>

                    @if ($hasText)
                        <div class="absolute inset-0 z-10 flex items-center">
                            <div class="mx-auto w-full max-w-7xl px-10 lg:px-16">
                                <div class="max-w-md text-left text-white">
                                    @if ($banner->title)
                                        <h2 class="line-clamp-2 text-3xl font-extrabold leading-tight tracking-tight drop-shadow-md lg:text-4xl">
                                            {{ $banner->title }}
                                        </h2>
                                    @endif

                                    @if ($banner->subtitle)
                                        <p class="mt-2 line-clamp-2 text-base text-white/90 drop-shadow-sm">
                                            {{ $banner->subtitle }}
                                        </p>
                                    @endif

                                    @if ($banner->button_text)
                                        <a href="{{ $banner->button_link ?: route('shop.products') }}"
                                            class="mt-5 inline-flex items-center justify-center gap-2 rounded-full bg-[#25D366] px-6 py-2.5 text-sm font-bold text-white shadow-md transition hover:bg-[#20ba59] active:scale-[0.98]">
                                            {{ $banner->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

            @if ($banners->count() > 1)
                <div class="absolute bottom-4 left-1/2 z-20 flex -translate-x-1/2 gap-1.5">
                    @foreach ($banners as $index => $banner)
                        <button @click="active = {{ $index }}" aria-label="Slide {{ $index + 1 }}"
                            :class="active === {{ $index }} ? 'w-5 bg-[#25D366]' : 'w-1.5 bg-white/50'"
                            class="h-1.5 rounded-full transition-all duration-300"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@else
    <section class="bg-gradient-to-br from-gray-900 to-black px-4 py-16 text-center text-white">
        <h2 class="text-2xl font-extrabold sm:text-4xl">{{ setting('hero_title', 'Selamat Datang') }}</h2>
        <p class="mt-2 text-sm text-white/80 sm:text-base">{{ setting('hero_subtitle', 'Temukan produk terbaik untuk Anda') }}</p>
    </section>
@endif