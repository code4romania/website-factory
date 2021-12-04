@props([
    'class' => 'block w-full',
    'src' => null,
    'alt' => '',
])

@if ($src)
    <img
        class="{{ $class }}"
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="lazy" />
@endif
