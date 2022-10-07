@props(['item'])

<div class="relative">
    <x-media.image
        class="absolute inset-0 object-cover w-full h-full"
        :src="$item['image']->getUrl()"
        :alt="$item['image']->caption" />


    @if ($item['color_overlay_enabled'])
        @if ($item['color_overlay'])
            <div class="absolute inset-0" style="background: {{ $item['color_overlay'] }}"></div>
        @else
            <div class="absolute inset-0 bg-primary mix-blend-multiply"></div>
        @endif
    @endif

    <div class="relative px-8 py-24 text-center sm:px-12 md:py-32 lg:py-40">
        <x-blocks._title :title="$item['title']" class="text-white empty:hidden" />

        <div class="mx-auto prose text-white max-w-prose sm:prose-lg">
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
