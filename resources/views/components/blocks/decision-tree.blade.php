<div x-data="decisionTree(@js($items->first()?->input('id')))">
    <button
        x-show="history.length"
        x-cloak
        x-on:click="goBack"
        class="inline-flex items-center px-2 py-1 text-sm font-semibold text-gray-900 rounded shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
    >
        <x-ri-arrow-left-line class="w-4 h-4 mr-2" />

        @lang('app.action.back')
    </button>

    @foreach ($items as $item)
        <div
            class="flex flex-col gap-2 py-2"
            x-show="isCurrent(@js($item->input('id')))"
            x-cloak
        >
            <h2 class="flex text-lg font-medium text-left text-gray-900 border-b">
                {{ $item->translatedInput('title') }}
            </h2>

            <div class="prose prose-primary empty:hidden">
                {!! $item->translatedInput('text') !!}
            </div>

            @if ($item->input('type') === 'answer')
                <div>
                    <button
                        x-cloak
                        x-on:click="goBackToStart"
                        class="inline-flex items-center px-2 py-1 text-sm font-semibold text-gray-900 rounded shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                    >
                        <x-ri-arrow-left-line class="w-4 h-4 mr-2" />

                        @lang('app.action.backToStart')
                    </button>
                </div>
            @elseif ($item->children->isNotEmpty())
                <div @class([
                    'grid gap-4',
                    match ((int) $item->input('columns')) {
                        default => 'sm:grid-cols-1',
                        2 => 'sm:grid-cols-2',
                        3 => 'sm:grid-cols-3',
                    },
                ])>
                    @foreach ($item->children as $choice)
                        <button
                            type="button"
                            class="relative flex flex-col px-4 py-5 overflow-hidden text-left bg-white border border-gray-100 rounded-lg shadow-md group focus:ring-2 focus:ring-inset focus:outline-none focus:ring-primary"
                            x-on:click="goTo(@js($choice->input('step')))"
                        >
                            <div
                                class="absolute flex items-end justify-center w-20 h-20 text-gray-400 transition-colors rotate-45 bg-gray-100 group-hover:text-primary group-hover:bg-primary/10 group-focus:text-primary group-focus:bg-primary/10 -top-10 -right-10">

                                <x-ri-check-line class="w-6 h-6 mb-1 -rotate-45" />
                            </div>

                            <h3 class="w-full pr-6 text-base font-semibold leading-6 text-gray-900">
                                {{ $choice->translatedInput('title') }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $choice->translatedInput('description') }}
                            </p>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
