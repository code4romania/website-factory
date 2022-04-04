<x-blocks._title :title="$title" />

@if ($image)
    <x-media.figure :src="$image->getUrl()" :caption="$image->caption" :preload="$shouldPreload()" />
@endif
