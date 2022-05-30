<x-layout>
    <header class="relative mb-16 sm:mb-24 lg:mb-32">
        <div class="container grid py-8 sm:py-12 lg:py-16 lg:grid-cols-2 lg:min-h-[50vh] items-center">
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
        </div>

        <div
            class="overflow-hidden mx-4 lg:mx-0 bg-gray-100 rounded-xl hero-side-image-clip lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:min-h-[50vh] lg:rounded-none">
            @if ($image)
                <x-media.image
                    class="w-full lg:object-cover lg:h-full"
                    :src="$image->getUrl()"
                    :alt="$image->caption" />
            @endif
        </div>
    </header>

    <x-blocks :model="$person" class="test" />
</x-layout>
