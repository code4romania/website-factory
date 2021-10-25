@if ($title)
    <h1 class="text-xl font-semibold">{{ $title }}</h1>
@endif

<x-media.figure :src="$image->getUrl()" :caption="$image->caption" />
