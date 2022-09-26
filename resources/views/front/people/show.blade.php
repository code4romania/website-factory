<x-layout>
    <header class="container grid items-center gap-8 py-8 sm:py-12 lg:py-16 lg:grid-cols-2 lg:gap-16">
        <div class="space-y-8">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-900 md:text-4xl lg:text-5xl">
                    {{ $person->name }}
                </h1>

                <p class="font-semibold text-primary sm:text-lg md:text-xl">
                    {{ $person->title }}
                </p>
            </div>

            <div class="prose text-gray-500 max-w-prose sm:prose-lg md:prose-xl">
                {!! $person->description !!}
            </div>

            <x-social-media-links :links="$person->social" />
        </div>

        @if ($image)
            <div
                class="overflow-hidden shadow-xl rounded-xl aspect-w-1 aspect-h-1">
                <x-media.image
                    class="object-cover"
                    :src="$image->getUrl()"
                    :alt="$image->caption" />
            </div>
        @endif
    </header>

    <x-blocks :model="$person" />
</x-layout>
