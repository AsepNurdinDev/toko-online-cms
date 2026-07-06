@props(['href', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->class([
        'group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-150',
        'bg-emerald-500/15 text-emerald-400' => $active,
        'text-slate-300 hover:bg-slate-800/70 hover:text-white' => ! $active,
    ]) }}
>
    @isset($icon)
        <span @class([
            'shrink-0 [&>svg]:w-5 [&>svg]:h-5',
            'text-emerald-400' => $active,
            'text-slate-400 group-hover:text-white' => ! $active,
        ])>{{ $icon }}</span>
    @endisset

    <span class="truncate">{{ $slot }}</span>
</a>
