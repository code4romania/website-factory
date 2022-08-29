@if ($showBanner)
    <x-site.code4banner />
@endif

<x-site.language-switcher />

<header x-data="{ menuOpen: false }" x-on:click.outside="menuOpen = false" class="relative shadow">
    <x-site.search-form class="container py-4 md:hidden" />

    <nav class="container py-4 space-y-4">
        <div class="relative flex items-center justify-between gap-3">
            <a href="{{ localized_route('front.pages.index') }}" class="inline-flex text-primary">
                @if ($logo)
                    <img
                        class="object-contain h-16 max-w-48 sm:max-w-64"
                        src="{{ $logo }}"
                        alt="{{ $title }}">
                @else
                    <x-icon-logo class="h-12 md:h-16" />
                @endif
            </a>

            <div class="flex items-center gap-3">
                <x-site.search-form class="hidden md:block" />

                <button type="button" x-on:click="menuOpen = !menuOpen" class="lg:hidden">
                    <x-ri-menu-line x-show="!menuOpen" class="w-5 h-5" />
                    <x-ri-close-line x-show="menuOpen" class="w-5 h-5" x-cloak />
                </button>
            </div>
        </div>

        <ul class="items-center hidden text-sm gap-x-3 lg:flex lg:flex-wrap">
            @foreach ($menu as $item)
                <li
                    @if ($item->children->isNotEmpty()) x-data="{ open: false }" x-on:click.outside="open = false" :class="{ 'text-primary bg-primary/10': open }" @endif
                    @class([
                        'flex flex-wrap border-b-2 border-transparent px-3 py-2 font-medium items-center',
                        $item->isCurrentUrl()
                            ? 'border-primary text-primary'
                            : 'text-gray-700 hover:text-primary',
                    ])>

                    <x-dynamic-component
                        :component="$item->component"
                        :item="$item" />

                    @if ($item->children->isNotEmpty())
                        <button
                            x-on:click="open = !open"
                            class="flex items-center ml-1.5 -mr-1">

                            <x-ri-arrow-down-s-line class="w-4 h-4" />
                        </button>

                        <div
                            class="absolute inset-x-0 z-10 text-gray-600 transform bg-white shadow-lg top-full"
                            x-show="open"
                            x-cloak>
                            <ul
                                class="container relative grid grid-cols-1 py-8 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 sm:gap-x-8 sm:py-12">
                                @foreach ($item->children as $item)
                                    <li>
                                        <x-dynamic-component
                                            :component="$item->component"
                                            :item="$item"
                                            class="font-semibold"
                                            inactive-class="text-gray-700 hover:text-primary"
                                            active-class="border-primary text-primary" />

                                        @if ($item->children)
                                            <ul class="pt-2 mt-2 space-y-2 border-t border-gray-200">
                                                @foreach ($item->children as $item)
                                                    <li class="flex">
                                                        <x-dynamic-component
                                                            :component="$item->component"
                                                            :item="$item"
                                                            inactive-class="text-gray-700 hover:text-primary"
                                                            active-class="border-primary text-primary hover:text-gray-800" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>

    <nav
        class="absolute inset-x-0 z-50 transition origin-top transform bg-white shadow-lg top-full lg:hidden"
        x-show="menuOpen"
        x-collapse
        x-cloak>
        <ul x-data="{
            open: null,
            toggle(id) {
                this.open = this.open !== id ? id : null;
            }
        }" class="container py-4 space-y-6 text-gray-600 md:py-8">
            @foreach ($menu as $item)
                <li class="flex flex-wrap">
                    <x-dynamic-component
                        :component="$item->component"
                        :item="$item"
                        class="flex-1" />

                    @if ($item->children->count())
                        <button
                            x-on:click="toggle({{ $loop->index }}) "
                            type="button">

                            <x-ri-arrow-down-s-line
                                class="transform w-7 h-7 p-0.5 text-gray-400"
                                ::class="{ '-rotate-180': open === {{ $loop->index }}, 'rotate-0': !(open) }" />
                        </button>

                        <ul class="w-full mt-4 space-y-6" x-show="open === {{ $loop->index }}" x-collapse>
                            @foreach ($item->children as $item)
                                <li>
                                    <x-dynamic-component
                                        :component="$item->component"
                                        :item="$item"
                                        class="font-medium" />

                                    @if ($item->children->count())
                                        <ul class="pt-2 mt-2 space-y-2 border-t border-gray-200">
                                            @foreach ($item->children as $item)
                                                <li>
                                                    <x-dynamic-component
                                                        :component="$item->component"
                                                        :item="$item" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>

    </nav>
</header>
