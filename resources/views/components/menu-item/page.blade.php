@props(['item', 'activeClass' => ''])

<a
    href="{{ $item->model->url }}"
    {{ $attributes->class([
        $activeClass => $item->isCurrentUrl(),
    ]) }}>
    {{ $item->model->title }}
</a>
