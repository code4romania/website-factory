@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

@if (null !== $item->model)
    <a
        {{ $attributes->merge([
            'href' => $item->model->url,
            'class' => $item->isCurrentUrl() ? $activeClass : $inactiveClass,
        ]) }}>
        {{ $item->label }}
    </a>
@endif
