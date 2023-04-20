@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

@if (Route::has("front.$item->route"))
    <a
        {{ $attributes->merge([
            'href' => localized_route("front.$item->route"),
            'target' => $item->new_tab && !$item->isCurrentUrl() ? '_blank' : null,
            'class' => $item->isCurrentUrl() ? $activeClass : $inactiveClass,
        ]) }}>
        {{ $item->label }}
    </a>
@endif
