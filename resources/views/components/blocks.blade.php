<div {{ $attributes->class('container grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-12') }}>
    @forelse ($blocks as $block)
        <div
            @class([
                'md:col-span-2' => $block->checkbox('fullwidth'),
            ])>

            <x-dynamic-component :component="$block->component" :block="$block" />

            @if (config('app.debug'))
                <details class="hidden mt-2">
                    <summary>Debug</summary>

                    @dump($block->content)
                </details>
            @endif
        </div>
    @empty
        No blocks found
    @endforelse
</div>
