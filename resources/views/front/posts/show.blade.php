<x-layout>
    <header class="relative mb-16 sm:mb-24 lg:mb-32">
        <div class="container grid py-8 sm:py-12 lg:py-16 lg:grid-cols-2 lg:min-h-[60vh] items-center">
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
            </div>
        </div>

        <div
            class="overflow-hidden mx-4 lg:mx-0 bg-gray-100 rounded-xl hero-side-image-clip lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:min-h-[60vh] lg:rounded-none">
            @if ($image)
                <x-media.image
                    class="w-full lg:object-cover lg:h-full"
                    :src="$image->getUrl()"
                    :alt="$image->caption" />
            @endif
        </div>
    </header>

    <x-blocks :model="$post" class="test" />
</x-layout>
