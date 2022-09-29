@props(['item'])

@if ($item->isRoot() && $item->children->isNotEmpty())
    <button
        x-on:click="open = !open"
        {{ $attributes->class('text-left') }}>

        {{ $item->label }}
    </button>
@else
    <span {{ $attributes }}>
        {{ $item->label }}
    </span>
@endif
