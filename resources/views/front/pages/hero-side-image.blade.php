@extends('front.layout')

@section('content')
    <header class="relative mb-16 sm:mb-24 lg:mb-32">
        <div class="container grid py-8 sm:py-12 lg:py-16 lg:grid-cols-2 lg:min-h-[50vh] items-center">
            <div class="space-y-8">
                <h1 class="text-4xl font-bold text-gray-900 md:text-5xl lg:text-6xl">
                    {{ $page->title }}
                </h1>

                <div class="prose text-gray-500 max-w-prose sm:prose-lg md:prose-xl">
                    {!! $page->description !!}
                </div>
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

    <x-blocks :model="$page" class="test" />
@endsection
