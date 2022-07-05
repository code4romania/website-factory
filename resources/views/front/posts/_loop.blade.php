<div class="container">
    <div class="grid gap-8 mb-8 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($posts as $post)
            <article class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                <a href="{{ $post->url }}" class="shrink-0">
                    <x-media.image
                        :src="$post->getMediaUrl('image', 'thumb')"
                        class="object-cover w-full h-56" />
                </a>
                <div class="flex-1 p-6 space-y-2 bg-white">
                    <x-categories :categories="$post->categories" class="text-sm" />

                    <time class="text-sm text-gray-500" datetime="{{ $post->published_at->toDateString() }}">
                        {{ $post->published_at->toLocaleDateString() }}
                    </time>

                    <a href="{{ $post->url }}" class="block space-y-3">
                        <h1 class="text-xl font-semibold text-gray-900 line-clamp-2">
                            {{ $post->title }}
                        </h1>
                        <p class="text-gray-500 line-clamp-3">
                            {{ $post->description }}
                        </p>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    {{ $posts->links() }}
</div>
