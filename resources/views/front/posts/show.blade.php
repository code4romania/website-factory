<x-layout>
    <header class="container grid items-center gap-8 my-8 lg:my-12 lg:grid-cols-2 lg:gap-16">
        <div>
            <div class="mb-2 text-base">
                <x-categories :categories="$post->categories" />

                <time class="text-gray-500" datetime="{{ $post->published_at->toDateString() }}">
                    {{ $post->published_at->toLocaleDateString() }}
                </time>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
                {{ $post->title }}
            </h1>

            <div class="mt-4 prose text-gray-500 max-w-prose sm:prose-lg md:prose-xl">
                {!! $post->description !!}
            </div>

            @if ($post->author)
                <p class="mt-6 text-base text-gray-500">
                    <strong class="font-medium">@lang('field.author'):</strong>
                    {{ $post->author }}
                </p>
            @endif
        </div>

        @if ($image)
            <div
                class="overflow-hidden bg-gray-100 shadow-xl aspect-w-3 aspect-h-2 rounded-xl">
                <x-media.image
                    class="object-cover"
                    :src="$image->getUrl()"
                    :alt="$image->caption" />
            </div>
        @endif
    </header>

    <x-blocks :model="$post" />
</x-layout>
