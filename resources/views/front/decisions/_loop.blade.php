<div class="container divide-y divide-gray-200">
    @foreach ($decisions as $decision)
        <article class="py-4 space-y-2">
            <a
                href="{{ route('front.decisions.show', [
                    'locale' => app()->getLocale(),
                    'decision' => $decision,
                ]) }}"
                class="block hover:underline">
                <h1 class="font-semibold text-gray-900 truncate">
                    {{ $decision->title }}
                </h1>
            </a>


            <div class="items-center space-y-2 text-sm text-gray-500 sm:flex sm:space-y-0 sm:space-x-6">
                <div class="flex items-center">
                    <x-ri-calendar-event-fill class="shrink-0 mr-1.5 h-5 w-5 text-gray-400" />

                    <time datetime="{{ $decision->created_at->toDateString() }}">
                        {{ $decision->created_at->isoFormat('D MMMM YYYY') }}
                    </time>
                </div>
                <div class="flex items-center">
                    <x-ri-price-tag-3-fill class="shrink-0 mr-1.5 h-5 w-5 text-gray-400" />

                    <x-categories :categories="$decision->categories" />
                </div>
            </div>

            <div class="prose-sm prose">
                {!! $decision->description !!}
            </div>
            </a>
        </article>
    @endforeach

    {{ $decisions->links() }}
</div>
