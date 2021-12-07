<x-blocks._title :title="$title" />

<div @class(['grid gap-8', $columns])>
    @foreach ($images as $image)
        <x-media.figure :src="$image->getUrl()" :caption="$image->caption" />
    @endforeach
</div>
