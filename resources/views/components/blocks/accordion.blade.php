@if ($title)
    <h1 class="text-xl font-semibold">{{ $title }}</h1>
@endif

<dl class="mt-6 space-y-6 divide-y divide-gray-200">
    @foreach ($items as $item)
        <div x-data="{ open: false }" class="pt-6">
            <dt class="text-lg">
                <button type="button" class="flex items-start justify-between w-full text-left text-gray-400"
                    @@click="open = !open">
                    <span class="font-medium text-gray-900">
                        {{ $item['title'] }}
                    </span>

                    <span class="flex items-center ml-6 h-7">
                        <x-ri-arrow-down-s-line class="w-6 h-6 transform rotate-0"
                            ::class="{ '-rotate-180': open, 'rotate-0': !(open) }" />
                    </span>
                </button>
            </dt>
            <dd class="pr-12 mt-2 prose prose-blue">
                {!! $item['text'] !!}
            </dd>
        </div>
    @endforeach
</dl>
