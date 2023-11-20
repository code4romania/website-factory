<nav
    {{ $attributes->class([
        'relative md:pr-2 my-8 lg:my-6 space-y-1 z-10',
        'border-b border-gray-200 md:border-b-0 md:border-r',
        'w-full md:w-72',
    ]) }}
    x-data="{
        isDesktop: () => window.innerWidth > 768,
        isOpen: true,
        init() {
            this.isOpen = this.isDesktop()
        },
        close() {
            if (this.isDesktop()) {
                return;
            }

            this.isOpen = false;
        }
    }"
    x-on:click.outside="close"
    @resize.window="isOpen = isDesktop()"
    class="relative shadow">

    <button
        type="button"
        x-on:click="isOpen = !isOpen"
        @class([
            'flex items-center justify-between w-full gap-3 md:hidden',
            'px-3 py-2 text-gray-900 border-l-4 bg-primary/5 border-primary',
        ])>
        <span class="text-sm font-medium text-left line-clamp-2">
            {{ $model->title }}
        </span>

        <x-ri-arrow-down-s-line
            class="w-6 h-6 shrink-0"
            ::class="isOpen ? '-rotate-180' : 'rotate-0'" />
    </button>

    <ul
        @class([
            'absolute top-full w-full md:relative md:top-0 z-50',
            'transition origin-top transform',
            'bg-white shadow md:shadow-none',
        ])
        x-show="isOpen"
        x-collapse
        x-cloak>
        @foreach ($items as $item)
            <x-nested-navigation.item :item='$item' />
        @endforeach
    </ul>
</nav>
