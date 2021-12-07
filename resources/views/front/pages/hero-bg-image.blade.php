@extends('front.layout')

@section('content')
    <header class="container my-16 sm:my-24 lg:my-32">
        <div class="relative overflow-hidden shadow-xl rounded-xl">
            @if ($image)
                <x-media.image
                    class="absolute inset-0 object-cover w-full h-full"
                    :src="$image->getUrl()"
                    :alt="$image->caption" />
            @endif

            <div class="absolute inset-0 bg-teal-700 mix-blend-multiply"></div>

            <div class="relative px-6 py-24 space-y-8 text-center sm:px-12 md:py-32 lg:py-40">
                <h1 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl">
                    {{ $page->title }}
                </h1>

                <div class="mx-auto prose text-white max-w-prose sm:prose-lg md:prose-xl">
                    {!! $page->description !!}
                </div>
            </div>
        </div>
    </header>

    <x-blocks :model="$page" class="test" />
@endsection
