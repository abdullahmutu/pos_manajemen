@props([
    'label' => '',
    'name',
    'placeholder' => '',
    'rows' => 3
])

<div>
    @if($label)
    <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wider"
           style="color:var(--slate);">
        {{ $label }}
    </label>
    @endif

    <textarea name="{{ $name }}" rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => 'w-full border rounded-xl px-4 py-2.5 text-sm outline-none resize-none',
            'style' => 'border-color:var(--border);'
        ]) }}>{{ old($name) }}</textarea>

    @error($name)
        <p class="text-xs mt-1" style="color:#DC2626;">{{ $message }}</p>
    @enderror
</div>