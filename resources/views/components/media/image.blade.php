@props([
    'src' => null,
    'alt' => '',
])

<img
    @class(['block', 'w-full'])
    src="{{ $src }}"
    alt="{{ $alt }}"
    loading="lazy" />
