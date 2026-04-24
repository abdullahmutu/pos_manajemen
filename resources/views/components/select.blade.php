@props([
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Pilih...',
])

<select name="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'border rounded-xl px-3 py-2 text-sm outline-none',
        'style' => 'border-color:var(--border);'
    ]) }}>

    <option value="">{{ $placeholder }}</option>

    @foreach($options as $option)
        <option value="{{ $option }}"
            {{ $selected == $option ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>