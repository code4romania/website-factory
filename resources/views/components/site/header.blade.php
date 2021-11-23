<header x-data="{ menuOpen: false }" x-on:click.outside="menuOpen = false" class="relative bg-teal-700">
    <nav class="container text-white lg:divide-teal-600 lg:divide-y">
        <div class="relative flex items-center justify-between py-4">
            <a href="{{ route('front.pages.index') }}" class="inline-flex">
                <img src="{{ $logo }}" alt="" class="h-10">
            </a>

            <div class="flex items-center gap-3">
                @if ($alternateUrls)
                    <div>
                        @foreach ($alternateUrls as $locale => $url)
                            <a
                                class="inline-flex p-2 text-sm rounded"
                                title="{{-- TODO --}}"
                                hreflang="{{ $locale }}"
                                href="{{ $url }}">
                                {{ strtoupper($locale) }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <button type="button" @@click="menuOpen = !menuOpen" class="lg:hidden">
                    <x-ri-menu-line x-show="!menuOpen" class="w-5 h-5" />
                    <x-ri-close-line x-show="menuOpen" class="w-5 h-5" x-cloak />
                </button>
            </div>
        </div>

        <ul class="relative items-center hidden py-3 text-sm gap-x-3 lg:flex lg:flex-wrap">
            @foreach ($menu as $item)
                @if ($item->children->count())
                    <li x-data="{ open: false }" x-on:click.outside="open = false">
                        <button
                            @@click="open = !open"
                            class="flex items-center px-3 py-2 font-medium text-teal-50 hover:text-teal-100"
                            :class="{ 'bg-teal-800': open }">
                            <span>{{ $item->label }}</span>

                            <x-ri-arrow-down-s-line
                                class="w-5 h-5 p-0.5 ml-1 -mr-2" />
                        </button>

                        <div
                            class="absolute inset-x-0 z-10 text-gray-500 transform bg-white shadow-lg top-full"
                            x-show="open"
                            x-cloak>
                            <ul
                                class="container relative grid grid-cols-1 py-8 text-sm sm:grid-cols-2 lg:grid-cols-4 gap-y-10 sm:gap-x-8 sm:py-12">
                                @foreach ($item->children as $subitemL1)
                                    <li>
                                        <x-dynamic-component
                                            :component="$subitemL1->component"
                                            :item="$subitemL1"
                                            class="text-base font-semibold text-gray-900 hover:text-gray-800" />

                                        @if ($subitemL1->children)
                                            <ol class="mt-3 space-y-3">
                                                @foreach ($subitemL1->children as $subitemL2)
                                                    <li class="flex">
                                                        <x-dynamic-component
                                                            :component="$subitemL2->component"
                                                            :item="$subitemL2"
                                                            class=" hover:text-gray-800" />
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li>
                        <x-dynamic-component :component="$item->component" :item="$item"
                            class="px-3 py-2 text-teal-50 hover:text-teal-100"
                            active-class="bg-teal-800 hover:text-teal-50" />
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>

    <nav
        class="absolute inset-x-0 z-50 transition origin-top transform bg-white shadow-lg top-full lg:hidden"
        x-show="menuOpen"
        x-collapse
        x-cloak>
        <ul class="container py-4 md:py-8">
            @foreach ($menu as $item)
                <li>
                    <x-dynamic-component :component="$item->component" :item="$item" />
                </li>
            @endforeach
        </ul>

    </nav>
</header>
