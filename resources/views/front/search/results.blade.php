<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            @lang('app.search.results', ['query' => $query])
        </h1>

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <div class="container">
        <div class="grid gap-8 lg:gap-12">
            @forelse ($items as $item)
                <article>
                    <a href="{{ $item->search_result->url_public }}"
                        class="font-semibold hover:underline">
                        <h1>{{ $item->search_result->title }}</h1>
                    </a>

                    <div class="max-w-prose">
                        <div class="prose prose-primary">
                            {!! $item->search_result->description !!}
                        </div>

                        <div class="mt-4 text-right">
                            <a href="{{ $item->search_result->url_public }}"
                                class="text-sm font-semibold text-primary hover:underline">
                                @lang('banner.more') <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <p>@lang('app.search.empty')</p>
            @endforelse
        </div>

        {{ $items->withQueryString()->links() }}
    </div>
</x-layout>
