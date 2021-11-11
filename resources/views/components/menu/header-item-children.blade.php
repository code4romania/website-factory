<div x-data="{ open: false }" x-on:click.outside="open = false">

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
        <ol
            class="container relative grid grid-cols-1 py-8 text-sm sm:grid-cols-2 lg:grid-cols-4 gap-y-10 sm:gap-x-8 sm:py-12">
            @foreach ($item->children as $subitemL1)
                <li>
                    <a href="{{ $subitemL1->url }}" class="text-base font-semibold text-gray-900 hover:text-gray-800">
                        {{ $subitemL1->label }}
                    </a>

                    @if ($subitemL1->children)
                        <ol class="mt-3 space-y-3">
                            @foreach ($subitemL1->children as $subitemL2)
                                <li class="flex">
                                    <a href="{{ $subitemL2->url }}" class="hover:text-gray-800">
                                        {{ $subitemL2->label }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>

                    @endif



                </li>
            @endforeach


        </ol>
    </div>
</div>
