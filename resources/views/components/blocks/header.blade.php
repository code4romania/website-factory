<div @class([
    'relative py-16 space-y-8 sm:py-24 flex flex-col',
    'text-center items-center justify-center' => $center,
])>
    <h1 class="text-3xl font-extrabold text-gray-900 md:text-4xl lg:text-5xl">
        {{ $title }}
    </h1>

    <div class="prose text-gray-500 max-w-prose sm:prose-lg lg:prose-xl">
        {!! $text !!}
    </div>
</div>
