<div class="relative overflow-hidden shadow-xl rounded-xl">
    @if ($image)
        <x-media.image
            class="absolute inset-0 object-cover w-full h-full"
            :src="$image->getUrl()"
            :alt="$image->caption"
            :preload="$shouldPreload()" />
    @endif

    <div class="absolute inset-0 bg-primary mix-blend-multiply"></div>

    <div class="relative px-6 py-24 space-y-8 text-center sm:px-12 md:py-32 lg:py-40">
        <h1 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl">
            {{ $title }}
        </h1>

        <div class="mx-auto prose text-white max-w-prose sm:prose-lg md:prose-xl">
            {!! $text !!}
        </div>

        @if ($button_url && $button_text)
            <a href="{{ $button_url }}"
                class="items-center block w-full px-5 py-3 mt-8 text-base font-medium text-center bg-white border border-transparent rounded-md shadow text-primary sm:w-auto sm:inline-block">
                {{ $button_text }}
            </a>
        @endif
    </div>
</div>
