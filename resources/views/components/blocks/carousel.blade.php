<div class="relative border" x-data="{
    length: @js($items->count()),
    current: 0,
    next() {
        this.current = (this.current === this.length - 1) ? 0 : this.current + 1;
    },
    previous() {
        this.current = this.current === 0 ? this.length - 1 : this.current - 1;
    }
}">
    @foreach ($items as $item)
        <div x-show="current === {{ $loop->index }}">
            <x-dynamic-component :component="$item['component']" :item="$item" />
        </div>
    @endforeach

    <nav>
        <div class="absolute top-0 bottom-0 flex items-center -left-6">
            <button
                class="w-12 h-12 p-2.5 bg-white border !rounded-full text-primary hover:shadow-lg"
                x-on:click="previous">
                <x-ri-arrow-left-line />
            </button>
        </div>

        <div class="absolute top-0 bottom-0 flex items-center -right-6">
            <button
                class="w-12 h-12 p-2.5 bg-white border !rounded-full text-primary hover:shadow-lg"
                x-on:click="next">
                <x-ri-arrow-right-line />
            </button>
        </div>
    </nav>
</div>
