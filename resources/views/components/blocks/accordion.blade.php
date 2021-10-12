@if ($title)
    <h1 class="text-xl font-semibold">{{ $title }}</h1>
@endif

<dl class="mt-4 divide-y divide-gray-200">
    @foreach ($items as $item)
        <x-blocks.accordion-item :number="$loop->iteration" :item="$item" />
    @endforeach
</dl>
