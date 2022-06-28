<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ $decision->title }}
        </h1>

        <div class="prose text-gray-500 max-w-prose sm:prose-lg lg:prose-xl">
            {!! $decision->description !!}
        </div>

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <x-blocks :model="$decision" />
</x-layout>
