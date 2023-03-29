<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-3xl font-bold text-gray-900 md:text-4xl lg:text-5xl">
            {{ $category->title }}
        </h1>

        <div class="mt-4 prose text-gray-500 sm:prose-lg lg:prose-xl">
            {!! $category->description !!}
        </div>

        <div class="mt-8 border-b border-gray-300"></div>
    </header>

    @include('front.posts._loop')
</x-layout>
