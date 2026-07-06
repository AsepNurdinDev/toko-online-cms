@props([
    'action',
    'confirm' => 'Data ini akan dihapus permanen dan tidak bisa dikembalikan.',
    'title' => 'Hapus Data?',
    'confirmLabel' => 'Ya, Hapus',
    'label' => null,
])

@php $formId = 'delete-form-'.\Illuminate\Support\Str::random(10); @endphp

<form id="{{ $formId }}" method="POST" action="{{ $action }}" class="hidden">
    @csrf
    @method('DELETE')
</form>

<button
    type="button"
    @click="$dispatch('open-confirm', {
        title: @js($title),
        message: @js($confirm),
        confirmLabel: @js($confirmLabel),
        formId: @js($formId),
    })"
    {{ $attributes->merge(['class' => 'rounded-md p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-600']) }}
    title="Hapus"
>
    @if ($label)
        {{ $label }}
    @else
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    @endif
</button>
