<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ $decision->title }}
        </h1>

        <div class="items-center mt-2 space-y-2 text-gray-500 sm:flex sm:space-y-0 sm:space-x-6">
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

        <div class="mt-4 prose text-gray-500 max-w-prose md:prose-lg">
            {!! $decision->description !!}
        </div>

        <x-media.attachments :items="$decision->getMedia('document')" class="mt-8" />

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <x-blocks :model="$decision" />
</x-layout>
