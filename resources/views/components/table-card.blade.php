@props([
    'title',
    'link' => null,
    'linkText' => 'Lihat semua',
    'fullHeight' => false
])

<div {{ $attributes->merge([
    'class' => 'bg-white rounded-2xl overflow-hidden ' . ($fullHeight ? 'flex flex-col h-full' : '')
]) }}
style="border:1px solid var(--border);">

    {{-- Header --}}
    <div class="px-6 py-4 flex items-center justify-between border-b"
         style="border-color:var(--border);">
        <h2 class="serif text-base">{{ $title }}</h2>

        @if($link)
        <a href="{{ $link }}"
           class="text-xs font-medium hover:underline"
           style="color:var(--pine);">
            {{ $linkText }} →
        </a>
        @endif
    </div>

    {{-- Content --}}
    <div class="{{ $fullHeight ? 'flex flex-col flex-1' : '' }}">
        {{ $slot }}
    </div>
</div>