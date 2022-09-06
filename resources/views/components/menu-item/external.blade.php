@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

@if ($item->url)
    <a
        {{ $attributes->merge([
            'href' => $item->url,
            'target' => '_blank',
            'rel' => 'noopener',
            'class' => $inactiveClass,
        ]) }}>
        {{ $item->label }}
    </a>
@endif
