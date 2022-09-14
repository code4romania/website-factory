<nav
    {{ $attributes->class([
        'px-2 py-6 my-2 lg:my-6 space-y-1',
        'border-t border-gray-200 md:border-t-0 md:border-r',
        'w-full md:w-72',
    ]) }}>

    <ul>
        @foreach ($items as $item)
            <x-nested-navigation.item :item='$item' />
        @endforeach
    </ul>
</nav>
