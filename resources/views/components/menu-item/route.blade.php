@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

@if (Route::has("front.$item->route"))
    <a
        {{ $attributes->merge([
            'href' => localized_route("front.$item->route"),
            'class' => $item->isCurrentUrl() ? $activeClass : $inactiveClass,
        ]) }}>
        {{ $item->label }}
    </a>
@endif
