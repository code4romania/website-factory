<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ __('app.search.results', ['query' => $query]) }}
        </h1>

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <div class="container space-y-8">
        <div class="grid gap-8 lg:gap-12">
            @forelse ($items as $item)
                <article>
                    <h1>
                        <a href="{{ $item->search_result->url_public }}">
                            {{ $item->search_result->title }}
                        </a>
                    </h1>

                    <div class="prose">
                        {!! $item->search_result->description !!}
                    </div>
                </article>
            @empty
                <p>{{ __('app.search.empty') }}</p>
            @endforelse
        </div>

        {{ $items->withQueryString()->links() }}
    </div>
</x-layout>
