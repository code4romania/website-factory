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

            <div class="items-center space-y-2 text-sm text-gray-500 sm:flex sm:space-y-0 sm:gap-x-6">
                <div class="flex items-center gap-1">
                    <x-ri-calendar-event-fill class="w-5 h-5 text-gray-400 shrink-0" />

                    @if ($decision->number)
                        <span>{{ $decision->number }}</span>
                        <span>/</span>
                    @endif

                    <time datetime="{{ ($decision->date ?? $decision->created_at)->toDateString() }}">
                        {{ ($decision->date ?? $decision->created_at)->isoFormat('D MMMM YYYY') }}
                    </time>
                </div>

                @if ($decision->categories->isNotEmpty())
                    <div class="flex items-center gap-1">
                        <x-ri-price-tag-3-line class="w-5 h-5 text-gray-400 shrink-0" />

                        <x-categories :categories="$decision->categories" />
                    </div>
                @endif

                @if ($decision->authors->isNotEmpty())
                    <div class="flex items-center gap-1">
                        <x-ri-shield-user-line class="w-5 h-5 text-gray-400 shrink-0" />

                        <x-categories :categories="$decision->authors" />
                    </div>
                @endif
            </div>

            <div class="prose-sm prose">
                {!! $decision->description !!}
            </div>
            </a>
        </article>
    @endforeach

    {{ $decisions->links() }}
</div>
