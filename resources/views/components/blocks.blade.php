@props(['container' => true])

<div
    @class([
        'grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-12 my-8 lg:my-12',
        'container' => $container,
    ])>
    @foreach ($blocks as $block)
        <div
            @class([
                'md:col-span-2' => $block->checkbox('fullwidth'),
                'empty:hidden',
            ])>

            <x-dynamic-component :component="$block->component" :block="$block" :index="$loop->index" />

            @if (app()->isLocal())
                <details class="mt-2">
                    <summary class="text-sm cursor-pointer">{{ $block->type }}</summary>

                    @dump($block->content)
                </details>
            @endif
        </div>
    @endforeach
</div>
