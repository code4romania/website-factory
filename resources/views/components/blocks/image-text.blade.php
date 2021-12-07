<div
    @class([
        'grid gap-8 grid-flow-row-dense',
        $containerColumns(),
        $containerAlign(),
    ])>
    @if ($image)
        <x-media.figure
            :class="$imageColumns()"
            :src="$image->getUrl()"
            :caption="$image->caption" />
    @endif

    <div @class([$contentColumns()])>
        <x-blocks._title :title="$title" />

        <div class="prose prose-lg prose-teal">
            {!! $html !!}
        </div>
    </div>
</div>
