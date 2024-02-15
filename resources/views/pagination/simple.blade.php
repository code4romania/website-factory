@if ($paginator->hasPages())
    <nav class="flex items-center justify-between border-t border-gray-200">
        <div class="flex flex-1 w-0 -mt-px">
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex items-center py-4 pr-1 text-sm font-semibold text-gray-700 border-t-2 border-transparent gap-x-3 hover:text-gray-500 hover:border-gray-300">
                    <x-ri-arrow-left-line class="w-5 h-5 text-gray-600" />
                    <span>@lang('pagination.previous')</span>
                </a>
            @endif
        </div>

        <div class="flex justify-end flex-1 w-0 -mt-px">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex items-center py-4 pr-1 text-sm font-semibold text-gray-700 border-t-2 border-transparent gap-x-3 hover:text-gray-500 hover:border-gray-300">
                    <span>@lang('pagination.next')</span>

                    <x-ri-arrow-right-line class="w-5 h-5 text-gray-600" />
                </a>
            @endif
        </div>
    </nav>
@endif
