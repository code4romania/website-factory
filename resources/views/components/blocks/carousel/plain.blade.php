@props(['item'])

<div>
    <div class="px-8 py-24 space-y-8 text-center sm:px-12 md:py-32 lg:py-40">
        <x-blocks._title :title="$item['title']" />

        <div class="mx-auto prose max-w-prose sm:prose-lg">
            {!! $item['text'] !!}
        </div>

        @if ($item['button_url'] && $item['button_text'])
            <a href="{{ $item['button_url'] }}"
                class="items-center block w-full px-5 py-3 mt-8 text-base font-medium text-center text-gray-800 border border-transparent rounded-md shadow bg-primary sm:w-auto sm:inline-block">
                {{ $item['button_text'] }}
            </a>
        @endif
    </div>
</div>
