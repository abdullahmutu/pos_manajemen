@props([
    'type' => 'button',
    'variant' => 'primary', // primary | outline | ghost | danger
    'href' => null,
])

@php
$base = "inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl transition-all duration-150";

$variants = [
    'primary' => "text-white",
    'outline' => "border",
    'ghost'   => "hover:underline",
    'danger'  => "text-white",
];

$styles = [
    'primary' => "background:var(--pine); color:#fff;",
    'outline' => "border-color:var(--border); color:var(--ink);",
    'ghost'   => "color:var(--pine);",
    'danger'  => "background:#EF4444; color:#fff;", // 🔥 FIX
];

// fallback biar gak error lagi
$variantClass = $variants[$variant] ?? $variants['primary'];
$variantStyle = $styles[$variant] ?? $styles['primary'];
@endphp

@if($href)
<a href="{{ $href }}"
   {{ $attributes->merge([
       'class' => $base . ' ' . $variantClass,
       'style' => $variantStyle
   ]) }}>
    {{ $slot }}
</a>
@else
<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => $base . ' ' . $variantClass,
        'style' => $variantStyle
    ]) }}>
    {{ $slot }}
</button>
@endif