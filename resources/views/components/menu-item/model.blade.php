@props(['item', 'inactiveClass' => '', 'activeClass' => ''])

@if (null !== $item->model)
    <a
        {{ $attributes->merge([
            'href' => $item->model->url,
            'target' => $item->new_tab && !$item->isCurrentUrl() ? '_blank' : null,
            'class' => $item->isCurrentUrl() ? $activeClass : $inactiveClass,
        ]) }}>
        {{ $item->label }}
    </a>
@endif
