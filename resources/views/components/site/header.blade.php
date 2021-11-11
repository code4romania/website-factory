<header class="relative text-white bg-teal-700">
    <div class="container lg:divide-teal-600 lg:divide-y">
        <div class="relative flex items-center justify-between py-4">
            <a href="{{ route('front.pages.index') }}" class="inline-flex">
                <img src="{{ $logo }}" alt="" class="h-10">
            </a>

            <div>
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
            </div>
        </div>

        <x-menu.header :items="$menu" class="hidden lg:flex" />

        {{-- <button type="button"
                class="flex px-3 py-2 font-medium text-gray-300 hover:bg-teal-800 hover:text-white focus:bg-teal-800 focus:text-white">
                <span>Solutions</span>
                <!--
                  Heroicon name: solid/chevron-down

                  Item active: "text-gray-600", Item inactive: "text-gray-400"
                -->
                <svg class="w-5 h-5 ml-2 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button> --}}



    </div>
</header>
