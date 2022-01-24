<div {{ $attributes->class('container grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-12') }}>
    @forelse ($blocks as $block)
        <div
            @class([
                'md:col-span-2' => $block->checkbox('fullwidth'),
                'empty:hidden',
            ])>

            <x-dynamic-component :component="$block->component" :block="$block" />

            @if (app()->environment(['local']))
                <details class="mt-2">
                    <summary class="text-sm cursor-pointer">Debug</summary>

                    @dump($block->content)
                </details>
            @endif
        </div>
    @empty
        No blocks found
    @endforelse
</div>
