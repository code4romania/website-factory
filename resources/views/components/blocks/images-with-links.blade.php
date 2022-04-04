<x-blocks._title :title="$title" />

<div @class(['grid gap-8', $columns])>
    @foreach ($items as $item)
        <a href="{{ $item['url'] }}" rel="noopener">
            <x-media.image :src="$item['image']?->getUrl()" :alt="$item['image']?->caption"
                :preload="$shouldPreload()" />
        </a>
    @endforeach
</div>
