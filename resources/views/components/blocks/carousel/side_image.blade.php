@props(['item'])

<div>
    <div
        class="grid items-center justify-center gap-8 px-8 py-24 sm:px-12 md:px-20 md:py-32 xl:grid-cols-11 lg:gap-16">
        <div class="space-y-8 sm:max-w-lg lg:max-w-2xl xl:max-w-none xl:col-span-6">
            <x-blocks._title :title="$item['title']" />

            <div class="prose max-w-prose sm:prose-lg">
                {!! $item['text'] !!}
            </div>

            @if ($item['button_url'] && $item['button_text'])
                <a href="{{ $item['button_url'] }}"
                    class="items-center block w-full px-5 py-3 mt-8 text-base font-medium text-center text-gray-800 border border-transparent rounded-md shadow bg-primary sm:w-auto sm:inline-block">
                    {{ $item['button_text'] }}
                </a>
            @endif
        </div>

        <div
            class="overflow-hidden bg-gray-100 shadow-sm rounded-xl sm:max-w-lg lg:max-w-2xl xl:col-span-5 xl:max-w-none">
            <x-media.image
                class="object-cover"
                :src="$item['image']->getUrl()"
                :alt="$item['image']->caption" />
        </div>
    </div>
</div>
