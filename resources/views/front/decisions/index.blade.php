<x-layout>
    <header class="container relative my-16 space-y-4 sm:my-24 lg:my-32">
        <h1 class="text-3xl font-bold text-gray-900 md:text-4xl lg:text-5xl">
            {{ trans_choice('decision.label', 2) }}
        </h1>

        <div class="prose text-gray-500 max-w-prose sm:prose-lg lg:prose-xl">
            {{-- {!! $decision->description !!} --}}
        </div>
    </header>

    @include('front.decisions._loop')
</x-layout>
