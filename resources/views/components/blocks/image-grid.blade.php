@if ($title)
    <h1 class="text-xl font-semibold">{{ $title }}</h1>
@endif

<div @class(['grid gap-8', $columns])>
    @foreach ($images as $image)
        <x-media.figure :src="$image->getUrl()" :caption="$image->caption" />
    @endforeach
</div>
