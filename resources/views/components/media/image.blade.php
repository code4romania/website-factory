@props([
    'class' => 'block w-full',
    'src' => null,
    'alt' => '',
    'preload' => false,
])

@if ($src)
    <img
        {{ $attributes->merge([
            'class' => $class,
            'src' => $src,
            'alt' => $alt,
            'loading' => !$preload ? 'lazy' : null,
        ]) }} />
@endif

@if ($preload)
    @push('preload')
        <link rel="preload" as="image" href="{{ $src }}" />
    @endpush
@endif
