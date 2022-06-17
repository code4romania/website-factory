@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

<a
    {{ $attributes->merge([
        'href' => $item->url,
        'target' => '_blank',
        'rel' => 'noopener',
        'class' => $inactiveClass,
    ]) }}>
    {{ $item->label }}
</a>
