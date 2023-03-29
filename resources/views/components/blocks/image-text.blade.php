<div @class([
    'grid gap-8 grid-flow-row-dense',
    $containerColumns(),
    $containerAlign(),
])>
    @if ($image)
        <x-media.figure
            :class="$imageColumns()"
            :src="$image->getUrl()"
            :caption="$image->caption"
            :preload="$shouldPreload()"
        />
    @endif

    <div @class([$contentColumns()])>
        <x-blocks._title :title="$title" />

        <div class="prose prose-lg prose-teal">
            {!! $html !!}
        </div>

        <div class="flex items-center mt-10 gap-x-3">
            @if ($primary_button_url && $primary_button_text)
                <a
                    href="{{ $primary_button_url }}"
                    class="inline-flex rounded-md bg-primary/10 px-3.5 py-2.5 text-sm font-semibold text-primary shadow-sm hover:bg-primary/5 border border-primary/25"
                >
                    {{ $primary_button_text }}
                </a>
            @endif

            @if ($secondary_button_url && $secondary_button_text)
                <a
                    href="{{ $secondary_button_url }}"
                    class="inline-flex items-center text-sm px-3.5 py-2.5 rounded-md font-semibold text-gray-900 gap-x-1 hover:bg-gray-50 border border-transparent"
                >
                    {{ $secondary_button_text }}
                    <x-ri-arrow-right-line class="w-4 h-4" />
                </a>
            @endif
        </div>
    </div>
</div>
