@props([
    'class' => 'block w-full',
    'src' => null,
    'alt' => '',
])

<img
    class="{{ $class }}"
    src="{{ $src }}"
    alt="{{ $alt }}"
    loading="lazy" />
