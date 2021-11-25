@props(['item'])

<a href="{{ $item->url }}" target="_blank" rel="noopener" {{ $attributes }}>
    {{ $item->label }}
</a>
