@props(['item'])

<a href="{{ $item->url }}" {{ $attributes }}>
    {{ $item->label }}
</a>
