@props(['number', 'item'])

<div x-data="{ open: false }" class="py-4">
    <dt>
        <button
            type="button"
            class="flex items-start justify-between w-full gap-4 text-lg font-medium text-left text-gray-900"
            @@click="open = !open">

            <span class="flex-shrink-0">
                {{ $number }}.
            </span>

            <span class="flex-1">
                {{ $item->translatedInput('title') }}
            </span>

            <x-ri-arrow-down-s-line
                class="transform w-7 h-7 p-0.5 text-gray-400"
                ::class="{ '-rotate-180': open, 'rotate-0': !(open) }" />
        </button>
    </dt>

    <dd x-show="open" x-collapse x-cloak>
        <div class="my-2 prose prose-blue">{!! $item->translatedInput('text') !!}</div>
    </dd>
</div>
