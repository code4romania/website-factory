@props(['items'])

<nav {{ $attributes->merge(['class' => 'py-3 relative space-x-3 text-sm']) }}>
    @foreach ($items as $item)
        @if ($item->children->count())
            <x-menu.header-item-children :item="$item" />
        @else
            <x-menu-item :item="$item" />
        @endif
    @endforeach
</nav>
