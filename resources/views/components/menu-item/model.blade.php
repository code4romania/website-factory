@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

<a
    {{ $attributes->merge([
        'href' => $item->model->url,
        'class' => $item->isCurrentUrl() ? $activeClass : $inactiveClass,
    ]) }}>
    {{ $item->label }}
</a>
