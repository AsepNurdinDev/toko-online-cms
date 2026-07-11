@props(['product'])

@php
    $hasDiscount = $product->discount_price && $product->discount_price < $product->price;
    $displayPrice = $hasDiscount ? $product->discount_price : $product->price;
@endphp

<div class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
    <a href="{{ route('shop.show', $product->slug) }}" class="relative block aspect-square overflow-hidden bg-gray-100">
        <img src="{{ storageUrl($product->thumbnail, 'images/no-image.png') }}"
            alt="{{ $product->name }}"
            class="h-full w-full object-cover transition duration-300 group-hover:scale-105">

        @if ($hasDiscount)
            <span class="absolute left-2 top-2 rounded-full bg-red-500 px-2.5 py-1 text-xs font-semibold text-white shadow-sm">
                -{{ discountPercentage($product->price, $product->discount_price) }}%
            </span>
        @endif

        @if ($product->stock <= 0)
            <div class="absolute inset-0 flex items-center justify-center bg-white/80 backdrop-blur-[1px]">
                <span class="rounded-full bg-gray-900 px-3 py-1 text-xs font-semibold text-white">Stok Habis</span>
            </div>
        @endif
    </a>

    <div class="flex flex-1 text-black flex-col p-3 sm:p-4">
        @if ($product->category)
            <span class="truncate text-[11px] font-semibold uppercase tracking-wide text-black sm:text-xs">
                {{ $product->category->name }}
            </span>
        @endif

        <a href="{{ route('shop.show', $product->slug) }}"
            class="mt-1 line-clamp-2 text-sm font-semibold leading-snug text-gray-900 transition hover:text-[var(--shop-primary-dark)]">
            {{ $product->name }}
        </a>

        <div class="mt-2 flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
            <span class="text-sm font-bold text-gray-900 sm:text-base">{{ rupiah($displayPrice) }}</span>
            @if ($hasDiscount)
                <span class="text-xs text-gray-400 line-through">{{ rupiah($product->price) }}</span>
            @endif
        </div>

        <div class="mt-auto pt-3">
            @if ($product->stock > 0)
                <a href="{{ waOrderLink($product, 1) }}" target="_blank" rel="noopener"
                    class="flex w-full items-center justify-center gap-1.5 rounded-lg bg-emerald-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-600 active:scale-[0.98]">
                    <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.15-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 5.001L2 22l5.117-1.341a9.958 9.958 0 0 0 4.887 1.244h.004c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.181-2.929-7.07a9.935 9.935 0 0 0-7.072-2.833zm0 18.187h-.003a8.184 8.184 0 0 1-4.166-1.14l-.299-.177-3.037.796.81-2.96-.194-.304a8.176 8.176 0 0 1-1.255-4.375c0-4.523 3.68-8.203 8.204-8.203a8.15 8.15 0 0 1 5.802 2.405 8.15 8.15 0 0 1 2.399 5.803c0 4.524-3.68 8.203-8.204 8.203z"/></svg>
                    Pesan
                </a>
            @else
                <button disabled class="w-full cursor-not-allowed rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-400">
                    Stok Habis
                </button>
            @endif
        </div>
    </div>
</div>