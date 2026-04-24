@props([
    'name' => 'search',
    'value' => '',
    'placeholder' => 'Cari...',
])

<div class="relative">
    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
         fill="none" viewBox="0 0 24 24" stroke="currentColor"
         style="color:var(--slate);">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35M17 11A6 6 0 111 11a6 6 0 0116 0z"/>
    </svg>

    <input type="text"
       name="{{ $name }}"
       value="{{ $value }}"
       placeholder="{{ $placeholder }}"
       oninput="autoSubmitSearch()"
       {{ $attributes->merge([
           'class' => 'w-full border rounded-xl pl-9 pr-3 py-2 text-sm outline-none',
           'style' => 'border-color:var(--border);'
       ]) }}
    >
</div>