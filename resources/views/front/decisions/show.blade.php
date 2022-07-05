<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ $decision->title }}
        </h1>

        <div class="items-center mt-1 space-y-2 text-gray-500 sm:flex sm:space-y-0 sm:space-x-6">
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

        <div class="mt-4 prose text-gray-500 max-w-prose md:prose-lg">
            {!! $decision->description !!}
        </div>

        <x-media.attachments :items="$decision->getMedia('document')" class="mt-8" />

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <x-blocks :model="$decision" />
</x-layout>
