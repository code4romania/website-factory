<x-blocks._title :title="$title" />

<div @class([
    'grid gap-8 grid-flor-row-dense md:grid-cols-3',
])>
    @if ($image)
        <x-media.figure :src="$image->getUrl()" :caption="$image->caption" />
    @endif

    <div class="prose prose-blue md:col-span-2">
        {!! $html !!}
    </div>
</div>
