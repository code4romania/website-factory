<div class="relative grid items-center lg:grid-cols-2">
    <div class="py-8 sm:py-16 md:py-20 lg:max-w-2xl lg:w-full lg:py-28 xl:py-32">
        <div class="mx-auto space-y-8 sm:text-center lg:text-left">
            <h1 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">
                {{ $title }}
            </h1>

            <div class="mx-auto prose text-gray-500 max-w-prose sm:prose-lg md:prose-xl">
                {!! $text !!}
            </div>
        </div>
    </div>

    <x-media.image
        class="w-full rounded-xl lg:rounded-none lg:object-cover lg:w-full lg:h-full hero-side-image-clip"
        :src="$image->getUrl()"
        :alt="$image->caption" />
</div>
