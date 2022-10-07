<div class="relative border rounded-xl" x-data="{
    length: @js($items->count()),
    current: 0,
    isCurrent(i) {
        return this.current === i;
    },
    setCurrent(i) {
        this.current = i;
    },
    next() {
        if (this.current < this.length - 1) {
            this.setCurrent(this.current + 1);
        } else {
            this.setCurrent(0)
        }
    },
    previous() {
        if (this.current > 0) {
            this.setCurrent(this.current - 1);
        } else {
            this.setCurrent(this.length - 1);
        }
    }
}">
    @foreach ($items as $item)
        <div x-show="isCurrent(@js($loop->index))" class="overflow-hidden">
            <x-dynamic-component :component="$item['component']" :item="$item" :x-cloak="$loop->first" />
        </div>
    @endforeach

    <nav>
        <div class="absolute top-0 bottom-0 flex items-center -left-4 sm:-left-6">
            <button
                class="w-8 h-8 sm:w-12 sm:h-12 p-1.5 sm:p-2.5 bg-white border !rounded-full text-primary hover:shadow-lg"
                x-on:click="previous"
                aria-label="@lang('pagination.previous')">
                <x-ri-arrow-left-line />
            </button>
        </div>

        <div class="absolute top-0 bottom-0 flex items-center -right-4 sm:-right-6">
            <button
                class="w-8 h-8 sm:w-12 sm:h-12 p-1.5 sm:p-2.5 bg-white border !rounded-full text-primary hover:shadow-lg"
                x-on:click="next"
                aria-label="@lang('pagination.next')">
                <x-ri-arrow-right-line />
            </button>
        </div>
    </nav>

    <nav
        class="absolute inset-x-0 flex flex-wrap justify-center max-w-md gap-3 mx-auto bottom-12 sm:max-w-lg lg:max-w-2xl">
        @foreach ($items as $item)
            <button
                type="button"
                class="w-3 h-3 !rounded-full shrink-0 shadow-sm"
                :class="[
                    isCurrent(@js($loop->index)) ? 'bg-primary' : 'bg-primary/40'
                ]"
                aria-current=""
                x-on:click="setCurrent(@js($loop->index))"></button>
        @endforeach
    </nav>
</div>
