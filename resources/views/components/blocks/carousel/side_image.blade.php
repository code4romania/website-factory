@props(['item'])

<div class="relative overflow-hidden bg-white shadow-xl rounded-xl">
    <div class="grid items-center justify-center gap-8 px-6 py-24 sm:px-12 md:py-32 lg:py-40 lg:grid-cols-11">
        <div class="space-y-8 sm:max-w-lg lg:col-span-6">
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
            class="overflow-hidden bg-gray-100 shadow-xl rounded-xl sm:max-w-lg lg:col-span-5 lg:max-w-none">
            <x-media.image
                class="object-cover"
                :src="$item['image']->getUrl()"
                :alt="$item['image']->caption" />
        </div>
    </div>
</div>
