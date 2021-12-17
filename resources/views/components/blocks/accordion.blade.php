<x-blocks._title :title="$title" />

<dl class="divide-y divide-gray-200">
    @foreach ($items as $item)
        <div x-data="{ isOpen: false }" class="py-4">
            <dt>
                <button
                    type="button"
                    class="flex items-start justify-between w-full gap-4 text-lg font-medium text-left text-gray-900"
                    @@click="isOpen = !isOpen">

                    <span class="shrink-0">
                        {{ $loop->iteration }}.
                    </span>

                    <span class="flex-1">
                        {{ $item->translatedInput('title') }}
                    </span>

                    <x-ri-arrow-down-s-line
                        class="transform w-7 h-7 p-0.5 text-gray-400"
                        ::class="isOpen ? '-rotate-180' : 'rotate-0'" />
                </button>
            </dt>

            <dd x-show="isOpen" x-collapse x-cloak>
                <div class="my-2 prose prose-blue">
                    {!! $item->translatedInput('text') !!}
                </div>
            </dd>
        </div>
    @endforeach
</dl>
