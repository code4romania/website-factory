@props([
    'src' => null,
    'alt' => '',
    'caption' => '',
    'preload' => false,
])

<figure {{ $attributes->class('') }}>
    <x-media.image :src="$src" :alt="$alt" :preload="$preload" />

    @if ($caption)
        <figcaption class="mt-4 text-sm text-gray-500">{{ $caption }}</figcaption>
    @endif
</figure>
