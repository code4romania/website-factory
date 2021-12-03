@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-16 border-t border-gray-200 sm:mt-24 lg:mt-32">
        <div class="flex flex-1 w-0 -mt-px">
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex items-center py-4 pr-1 space-x-3 text-sm font-semibold text-gray-700 border-t-2 border-transparent hover:text-gray-500 hover:border-gray-300">
                    <x-ri-arrow-left-line class="w-5 h-5 text-gray-600" />
                    <span>@lang('pagination.previous')</span>
                </a>
            @endif
        </div>

        <div class="hidden md:-mt-px md:flex">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true"
                        class="inline-flex items-center px-4 py-4 text-sm font-semibold text-gray-700 border-t-2 border-transparent">{{ $element }}</span>

                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                class="inline-flex items-center px-4 py-4 text-sm font-semibold text-teal-600 border-t-2 border-teal-500">{{ $page }}</span>

                        @else
                            <a href="{{ $url }}"
                                class="inline-flex items-center px-4 py-4 text-sm font-semibold text-gray-700 border-t-2 border-transparent hover:text-gray-700 hover:border-gray-300"
                                aria-label="{{ __('pagination.goto', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class="flex justify-end flex-1 w-0 -mt-px">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex items-center py-4 pr-1 space-x-3 text-sm font-semibold text-gray-700 border-t-2 border-transparent hover:text-gray-500 hover:border-gray-300">
                    <span>@lang('pagination.next')</span>

                    <x-ri-arrow-right-line class="w-5 h-5 text-gray-600" />
                </a>
            @endif
        </div>
    </nav>
@endif
