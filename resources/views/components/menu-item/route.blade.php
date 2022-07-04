@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

<a
    {{ $attributes->merge([
        'href' => localized_route("front.$item->route"),
        'class' => $item->isCurrentUrl() ? $activeClass : $inactiveClass,
    ]) }}>
    {{ $item->label }}
</a>
