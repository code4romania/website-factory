@switch($item->type)
    @case('external')

        <a href="{{ $item->url }}" class="px-3 py-2 font-medium text-teal-50 hover:text-teal-100">
            {{ $item->label }}
        </a>

    @break


@endswitch
