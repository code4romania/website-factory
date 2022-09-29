<li class="divide-y divide-gray-100">
    <a
        @class([
            'block px-3 py-2 text-sm font-medium border-l-4',
            Request::url() === $item->url
                ? 'text-gray-900 bg-primary/5 border-primary'
                : 'text-gray-600 border-transparent hover:border-primary/25 hover:bg-primary/5',
        ])
        href="{{ $item->url }}">
        <span class="line-clamp-2">{{ $item->title }}</span>
    </a>

    @if ($item->children->isNotEmpty())
        <ul class="pl-4">
            @foreach ($item->children as $item)
                <x-nested-navigation.item :item='$item' />
            @endforeach
        </ul>
    @endif
</li>
