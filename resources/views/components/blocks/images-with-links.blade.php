<x-blocks._title :title="$title" />

<div @class(['grid gap-8', $columns])>
    @foreach ($items as $item)
        <div>
            @if ($item['url'])
                <a href="{{ $item['url'] }}" rel="noopener">
                    <x-media.image :src="$item['image']?->getUrl()" :alt="$item['image']?->caption"
                        :preload="$shouldPreload()" />
                </a>
            @else
                <x-media.image :src="$item['image']?->getUrl()" :alt="$item['image']?->caption"
                    :preload="$shouldPreload()" />
            @endif

            @if ($item['caption'])
                <div class="mt-2 prose-sm prose prose-primary">
                    {!! $item['caption'] !!}
                </div>
            @endif
        </div>
    @endforeach
</div>
