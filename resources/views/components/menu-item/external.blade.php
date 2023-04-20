@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

@if ($item->url)
    <a
        {{ $attributes->merge([
            'href' => $item->url,
            'target' => $item->new_tab ? '_blank' : null,
            'rel' => 'noopener',
            'class' => $inactiveClass,
        ]) }}>
        {{ $item->label }}
    </a>
@endif
