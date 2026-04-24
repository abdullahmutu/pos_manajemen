@props([
    'label',
    'value',
    'sub' => null,
    'bg' => '#fff',
    'accent' => '#000',
    'icon' => ''
])

<div class="rounded-2xl p-5 flex flex-col gap-3"
     style="background:{{ $bg }};">
    
    <div class="w-9 h-9 rounded-xl flex items-center justify-center"
         style="background:{{ $accent }}1A;">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="1.8"
             style="color:{{ $accent }};">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
        </svg>
    </div>

    <div>
        <div class="text-xs font-medium mb-0.5"
             style="color:{{ $accent }}; opacity:.7;">
            {{ $label }}
        </div>

        <div class="text-2xl font-bold leading-none"
             style="color:{{ $accent }};">
            {{ $value }}
        </div>

        @if($sub)
        <div class="text-xs mt-1"
             style="color:{{ $accent }}; opacity:.6;">
            {{ $sub }}
        </div>
        @endif
    </div>
</div>