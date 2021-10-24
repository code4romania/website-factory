@props([
    'src' => null,
    'alt' => '',
    'caption' => '',
])

<figure class="">
    <x-media.image :src="$src" :alt="$alt" />

    @if ($caption)
        <figcaption class="mt-4 text-sm text-gray-500">{{ $caption }}</figcaption>
    @endif
</figure>
