@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => ''
])

<div>
    @if($label)
    <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wider"
           style="color:var(--slate);">
        {{ $label }}
    </label>
    @endif

    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           {{ $attributes->merge([
               'class' => 'w-full border rounded-xl px-4 py-2.5 text-sm outline-none',
               'style' => 'border-color:var(--border);'
           ]) }}>

    @error($name)
        <p class="text-xs mt-1" style="color:#DC2626;">{{ $message }}</p>
    @enderror
</div>