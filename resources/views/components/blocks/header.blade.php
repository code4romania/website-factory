<div @class([
    'relative py-16 sm:py-24 flex flex-col',
    'text-center items-center justify-center' => $center,
])>
    <h1 class="mb-8 text-3xl font-bold text-gray-900 md:text-4xl lg:text-5xl empty:hidden">
        {{ $title }}
    </h1>

    <div class="prose max-w-prose sm:prose-lg lg:prose-xl">
        {!! $text !!}
    </div>
</div>
